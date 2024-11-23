<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\HomeServiceInterface as HomeService;
use App\Repositories\Interfaces\CommentRepositoryInterface as CommentRepository;
use App\Services\Interfaces\CommentServiceInterface as CommentService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $homeService;
    protected $commentRepository;
    protected $commentService;

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
        // dd($lastestNews);   
        $config = $this->config();
        $template = 'client.layouts.layout';
        $getCatalogue = $this->homeService->getActiveParentCategoriesWithChildren();
        // dd($getCatalogue);
        $cate_ids = [];
        foreach ($getCatalogue as $cateParent) {
            $cate_ids[] = $cateParent->id;
            foreach ($cateParent->post_catalogue_children as $cateChild)
                $cateChild->encrypted_id = $this->encryptId($cateChild->id);
        }
        // dd($cate_ids);
        $count = 0;
        $results = [];
        foreach ($cate_ids as $key => $val) {
            // dd($val);
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
            // dd($lastestNewsByCateChild);
            $results[] = $lastestNewsByCateChild;
            $count++;
        }
        // dd($results);
        // dd($getCatalogue);
        foreach ($lastestNewsByCateChild as $new) {
            $new->encrypted_id = $this->encryptId($new->id);
        }
        // dd($getCatalogue);
        foreach ($results as $cate) {
            foreach ($cate as $post) {
                $post->encrypted_id = $this->encryptId($post->id);
            }
        }
        // $getPostByCate =  $this->homeService->getPostsByCategory($id, $model);
        // dd($getCatalogue);
        // dd($categories);
        return view('client.index', compact('template', 'config', 'lastestNews', 'getCatalogue', 'results'));
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
        // dd($id);
        $categoryInfo = $this->homeService->getCategoryInfo($id, $model);
        // dd( $categoryInfo);
        $category = $this->homeService->getPostsByCategory($id, $model);

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
                    'customers' => $comment->customers,
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
    private function config()
    {
        return [
            'js' => [
                'client/vendor/jquery/jquery-3.2.1.min.js',
                'client/vendor/animsition/js/animsition.min.js',
                'client/vendor/bootst            $comments = [];
rap/js/popper.js',
                'client/vendor/bootstrap/js/bootstrap.min.js',
                'client/js/main.js',
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
                'client/css/main.css'
            ],
        ];
    }
}
