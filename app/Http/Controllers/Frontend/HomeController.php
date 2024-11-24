<?php

namespace App\Http\Controllers\Frontend;

use App\Models\PostLike;
use App\Models\Tag;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\HomeServiceInterface as HomeService;
use App\Repositories\Interfaces\CommentRepositoryInterface as CommentRepository;
use App\Services\Interfaces\CommentServiceInterface as CommentService;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\DumpHandler;

class HomeController extends Controller
{
    protected $homeService;
    protected $commentRepository;

    public function __construct(HomeService $homeService, CommentRepository $commentRepository, CommentService $commentService)
    {
        $this->homeService = $homeService;
        $this->commentRepository=$commentRepository;
        $this->commentService=$commentService;
    }

    public function index(Request $request)
    {
        $lastestNews = $this->homeService->getLastestNew();
        foreach ($lastestNews as $new) {
            $new->encrypted_id = $this->encryptId($new->id);
        }
        $config = $this->config();
        $template = 'client.layouts.layout';
        $getCatalogue = $this->homeService->getActiveParentCategoriesWithChildren();
        $cate_ids = [];
        foreach ($getCatalogue as $cateParent) {
            $cate_ids[] = $cateParent->id;
            foreach ($cateParent->post_catalogue_children as $cateChild)
                $cateChild->encrypted_id = $this->encryptId($cateChild->id);
        }
        $count = 0;
        $results = [];
        foreach ($cate_ids as $key => $val) {
            if ($count > 4) {
                break;
            }
            $conditions = [
                ['publish', '=', 2],
                ['post_catalogue_parent_id', '=', $val] // Điều kiện mặc định, có thể thay đổi tuỳ yêu cầu
            ];
            $relation = [
                'postCatalogueChildren' => function ($query) {
                    $query->where('publish', 2);
                }
            ];
            $lastestNewsByCateChild = $this->homeService->getLastestNew(4, $relation, $conditions);
            $results[] = $lastestNewsByCateChild;
            $count++;
        }
        // dd($results);
        // dd($getCatalogue);
        if (!empty($lastestNewsByCateChild)) {
            foreach ($lastestNewsByCateChild as $new) {
                $new->encrypted_id = $this->encryptId($new->id);
            }
        } else {
            $lastestNewsByCateChild = null;
        }
        $posts = $this->getPostLike();
        foreach ($posts as $post) {
            $post->encrypted_id = $this->encryptId($post->id);
        }
        $view = $this->getTopViewedPosts();
        foreach ($view as $views) {
            $views->encrypted_id = $this->encryptId($views->id);
        }
        foreach ($results as $cate) {
            foreach ($cate as $post) {
                $post->encrypted_id = $this->encryptId($post->id);
            }
        }
        $tags = $this->getAllTag();
        return view('client.index', compact('template', 'config', 'lastestNews', 'getCatalogue', 'results', 'posts', 'view','tags'));
    }

    public function getPostLike()
    {
        $posts = Post::withCount('likes')
            ->having('likes_count', '>=', 2)
            ->orderBy('likes_count', 'desc')
            ->take(4)->get();
        return $posts;
    }
    public function getTopViewedPosts()
    {
        $posts = Post::join('post_views', 'posts.id', '=', 'post_views.post_id')
            ->select('posts.*', 'post_views.view_count')
            ->where('post_views.view_count', '>', 50)
            ->orderBy('post_views.view_count', 'desc')
            ->limit(3)
            ->get();

        return $posts;
    }
    public function getAllTag()
    {
        $tags = Tag::all();
        return $tags;
    }
    public function category($id, $model)
    {
        $template = 'client.category';
        $config = $this->config();
        $id = $this->decryptId($id);
        // dd($id);
        if (!preg_match('/^[0-9A-Za-z=]+$/', $id)) {
            return redirect()->route('client.index')->withErrors('ID không hợp lệ. Vui lòng sử dụng ID đã mã hóa.');
        }

        $categoryInfo = $this->homeService->getCategoryInfo($id, $model);
        $category = $this->homeService->getPostsByCategory($id, $model);
        //    dd($category);

        foreach ($category as $cate) {
            foreach ($cate->posts as $post) {
                $post->encrypted_id = $this->encryptId($post->id);
            }
        }
        // dd($category);
        // dd($category[0]->posts[0]->encrypted_id);
        return view($template, compact('config', 'categoryInfo', 'category'));
    }

    public function detail($id)
    {
        // dd($id);
        $template = 'client.detail';
        $config = $this->config();
        $id = $this->decryptId($id);
        // dd($id);
        if (!preg_match('/^[0-9A-Za-z=]+$/', $id)) {
            return redirect()->route('client.index')->withErrors('ID không hợp lệ. Vui lòng sử dụng ID đã mã hóa.');
        }
        $getPost = $this->homeService->getPost($id);

        if (isset($getPost->postCatalogueChildren)) {
            $getPost->postCatalogueParent_encrypted_id = $this->encryptId($getPost->postCatalogueParent->id);
            $getPost->postCatalogueChildren_encrypted_id = $this->encryptId($getPost->postCatalogueChildren->id);
        } else {
            $getPost->postCatalogueParent_encrypted_id = $this->encryptId($getPost->postCatalogueParent->id);
        }
        // dd($getPost);

        // --------------------------------------- Comments --------------------------------------

        $condition = [
            ['post_id', '=', $id],
            ['parent_id', '=', '0']
        ];

        $comments = $this->commentRepository->findByConditionsWithRelation($condition,[],['id','desc']);

        $client_logged = Auth::id();
        // dd($client_logged);

        if($comments->isNotEmpty()){
            foreach($comments as $comment){
                $commentIds[]=$comment->id;
            }
            // dd($commentIds);
    
            $countCommentReplyId = [];
            foreach($commentIds as $commentId){
                $countCommentReplyId[]=$this->commentService->countCommentReply($commentId);
            }
            // dd($countCommentReplyId);
    
            $countReply = $this->commentService->countNestedArray($countCommentReplyId);
            // dd($countReply);
    
            foreach ($comments as $key => $comment) {
                $comment->reply_count = $countReply[$key] ?? 0;
            }
            // dd($comments);
    
            $comments->each(function ($comment, $key) use ($countCommentReplyId) {
                $nestedIds = isset($countCommentReplyId[$key]) ? $this->commentService->collectNestedIds($countCommentReplyId[$key]) : [];
                $comment->reply_ids = $nestedIds;
            });
            // dd($comments);
    
            $comments = $comments->map(function ($comment) use ($client_logged) {
                return [
                    'id' => $comment->id,
                    'parent_id' => $comment->parent_id,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at,
                    'reply_ids' => $comment->reply_ids,
                    'reply_count' => $comment->reply_count,
                    'customers' => $comment->customers ? $comment->customers->only(['cus_id', 'cus_user', 'email']) : null,
                    'post_id' => $comment->post_id,
                    'customer_id' => $comment->customer_id,
                    'avatar' => asset('Backend/img/not-found.png'),
                    'img_reply' => asset('Backend/img/Reply.svg'),
                ];
            });
            // dd($comments);
        }
        return view($template, compact('config', 'getPost', 'comments', 'client_logged'));
    }

    public function search(SearchRequest $request)
    {
        $template = 'client.search-result';
        $config = $this->config();

        $requestInput = $request->input('search');
        $results = $this->homeService->getPostsBySearch($requestInput);
        foreach ($results as $result) {
            $result->encrypted_id = $this->encryptId($result->id);
        }

        // dd($results);

        return view($template, compact('config', 'results'));
    }



    public function tagPostResult($tagId)
    {
        $tag = $this->getPostsByTag($tagId);
        foreach ($tag->posts as $tags) {
            $tags->encrypted_id = $this->encryptId($tags->id);
        }
        $posts = $tag->posts;
        $config = $this->config();
        return view('client.Tag', compact('config', 'tag', 'posts'));
    }
    private function getPostsByTag($tagId)
    {
        $tag = Tag::with('posts')->findOrFail($tagId);
        return $tag;
    }
    public function myactives()
    {
        $customerId = auth()->id();

        $likes = $this->getUserLikes($customerId);
        foreach ($likes as $like) {
            $like->encrypted_id = $this->encryptId($like->id);
        }
        $savedFolders = $this->getUserSavePost($customerId);
        foreach ($savedFolders as $folderGroup) {
            foreach ($folderGroup as $savedPost) {
                $savedPost->encrypted_post_id = $this->encryptId($savedPost->post_id);
            }
        }
        $config = $this->config();
        return view('client.myactive', compact('config', 'likes', 'savedFolders'));
    }
    public function getUserLikes($customerId)
    {
        return DB::table('likes')
            ->join('posts', 'likes.post_id', '=', 'posts.id')
            ->where('likes.cus_id', $customerId)
            ->whereNull('likes.deleted_at')
            ->whereNull('posts.deleted_at')
            ->select('posts.post_name', 'posts.id', 'likes.created_at')
            ->get();

    }
    public function getUserSavePost($customerId)
    {
        $savedFolders = DB::table('save_folders')
            ->join('saves', 'save_folders.folder_id', '=', 'saves.save_folder_id')
            ->join('posts', 'saves.post_id', '=', 'posts.id')
            ->where('save_folders.cus_owned', $customerId)
            ->select(
                'save_folders.folder_id',
                'save_folders.folder_name',
                'save_folders.description',
                'posts.id as post_id',
                'posts.post_name'
            )
            ->get();
        $groupedFolders = $savedFolders->groupBy('folder_id');
        foreach ($savedFolders as $folder) {
            $folder->encrypted_post_id = $this->encryptId($folder->post_id);
        }
        return $groupedFolders;
    }
    private function config()
    {
        return [
            'js' => [
                'client/vendor/jquery/jquery-3.2.1.min.js',
                'client/vendor/animsition/js/animsition.min.js',
                'client/vendor/bootstrap/js/popper.js',
                'client/vendor/bootstrap/js/bootstrap.min.js',
                'client/js/main.js',
                'https://solascore.io/js/matches.js?v=<?=time();?>',
                'Backend/libary/client/comment.js',
            ],
            'css' => [
                'client/vendor/bootstrap/css/bootstrap.min.css',
                'client/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css',
                'client/fonts/iconic/css/material-design-iconic-font.min.css',
                'client/vendor/animate/animate.css',
                'client/vendor/css-hamburgers/hamburgers.min.css',
                'client/vendor/animsition/css/animsition.min.css',
                'client/css/util.min.css',
                'client/css/main.css',
                'https://solascore.io/css/style.css?v=<?=time();?>',
            ],
        ];
    }
}
