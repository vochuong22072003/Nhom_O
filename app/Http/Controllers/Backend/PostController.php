<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Http\Requests\StorePostRequest;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostLike;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildrenRepository;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\UserInfoRepositoryInterface as UserInfoRepository;

class PostController extends Controller
{
    protected $postService;
    protected $postRepository;
    protected $postCatalogueParentRepository;
    protected $postCatalogueChildrenRepository;
    protected $userRepository;
    protected $userInfoRepository;

    public function __construct(PostService $postService, PostRepository $postRepository, PostCatalogueParentRepository $postCatalogueParentRepository, PostCatalogueChildrenRepository $postCatalogueChildrenRepository, UserRepository $userRepository, UserInfoRepository $userInfoRepository)
    {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->postCatalogueParentRepository = $postCatalogueParentRepository;
        $this->postCatalogueChildrenRepository = $postCatalogueChildrenRepository;
        $this->userRepository = $userRepository;
        $this->userInfoRepository = $userInfoRepository;
    }




    public function index(Request $request)
    {
        $config = $this->configIndex();

        $template = 'Backend.post.post.index';

        $config['seo'] = config('apps.post.index');

        $posts = $this->postService->paginate($request);

        foreach ($posts as $post) {

            $post->encrypted_id = $this->encryptId($post->id);
            $condition = [
                ['user_id', '=', $post->user_id]
            ];
            $post->user_info = $this->userInfoRepository->findByCondition($condition);
        }

        $postCataloguesParent = $this->postCatalogueParentRepository->all();

        $postCataloguesChildren = $this->postCatalogueChildrenRepository->all();
        // dd($postCataloguesParent);

        $this->authorize('modules', 'post.index');
        // dd($posts);

        return view('Backend.dashboard.layout', compact('template', 'config', 'posts', 'postCataloguesParent', 'postCataloguesChildren'));
    }

    public function store()
    {
        $template = 'Backend.post.post.store';

        $config = $this->configCUD();

        $config['seo'] = config('apps.post.create');

        $config['method'] = 'create';

        $postCataloguesParent = $this->postCatalogueParentRepository->all();

        $this->authorize('modules', 'post.store');

        return view('Backend.dashboard.layout', compact('template', 'config', 'postCataloguesParent'));
    }

    public function create(StorePostRequest $request)
    {
        if ($this->postService->createPost($request)) {
            $this->addTags($request);
            return redirect()->route('post.index')->with('success', 'Thêm mới bài viết thành công');
        }
        return redirect()->route('post.index')->with('error', 'Thêm mới bài viết thất bại. Hãy thử lại');
    }
    public function edit($id)
    {
        $id = $this->decryptId($id);

        if (!preg_match('/^[0-9A-Za-z=]+$/', $id)) {
            return redirect()->route('post.index')->withErrors('ID không hợp lệ. Vui lòng sử dụng ID đã mã hóa.');
        }

        $template = 'Backend.post.post.store';

        $config = $this->configCUD();

        $config['seo'] = config('apps.post.edit');

        $config['method'] = 'edit';

        $post = $this->postRepository->findById($id);

        $postCataloguesParent = $this->postCatalogueParentRepository->all();

        $album = json_decode($post->album);

        $this->authorize('modules', 'post.edit');

        $id_logged = Auth::id();

        $user_logged = $this->userRepository->findById($id_logged);

        $condition = [
            ['id', '=', $id]
        ];

        $postInfo = $this->postRepository->findByCondition($condition);

        if ($user_logged->id != $postInfo->user_id && $user_logged->user_catalogue_id != 1) {
            return redirect()->route('post.index')->with('error', 'Bạn không phải là tác giả của bài viết này nên không thể cập nhật nó.');
        }

        return view('Backend.dashboard.layout', compact('template', 'config', 'post', 'postCataloguesParent', 'album'));
    }
    public function update($id, UpdatePostRequest $request)
    {
        // dd($request);
        if ($this->postService->updatePost($id, $request)) {
            return redirect()->route('post.index')->with('success', 'Cập nhật bài viết thành công');
        }
        return redirect()->route('post.index')->with('error', 'Cập nhật bài viết thất bại. Hãy thử lại');
    }
    public function destroy($id)
    {
        $id = $this->decryptId($id);

        if (!preg_match('/^[0-9A-Za-z=]+$/', $id)) {
            return redirect()->route('post.index')->withErrors('ID không hợp lệ. Vui lòng sử dụng ID đã mã hóa.');
        }

        $template = 'Backend.post.post.destroy';

        $config = $this->configCUD();

        $config['seo'] = config('apps.post.delete');

        $post = $this->postRepository->findById($id);

        $postCataloguesParent = $this->postCatalogueParentRepository->all();

        $this->authorize('modules', 'post.destroy');

        return view('Backend.dashboard.layout', compact('template', 'config', 'post', 'postCataloguesParent'));
    }
    public function delete($id)
    {
        if ($this->postService->deletePost($id)) {
            return redirect()->route('post.index')->with('success', 'Xóa bài viết thành công');
        }
        return redirect()->route('post.index')->with('error', 'Xóa bài viết thất bại. Hãy thử lại');
    }
  // xử lý thêm tag 
    private function addTags(Request $request)
    {
        $postId = Post::where('post_name', $request->input('post_name'))
        ->whereDate('created_at', now()
        ->toDateString())
        ->value('id');
        $strTags = $request->input('tags');
        $tags = explode(' ', $strTags);
        foreach ($tags as $tagName) {
            $tag = DB::table('tags')->where('tag_name', $tagName)->first();
            if (!$tag) {
                $tagId = DB::table('tags')->insertGetId([
                    'tag_name' => $tagName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $tagId = $tag->tag_id;
            }
            DB::table('post_tags')->updateOrInsert([
                'post_id' => $postId,
                'tag_id' => $tagId,
            ]);
        }
        return redirect()->back()->with('success', 'Tags đã được thêm vào bài viết!');
    }
    private function configIndex()
    {
        return [
            'js' => [
                'Backend/vendor/jquery/jquery.min.js',
                'Backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'Backend/vendor/jquery-easing/jquery.easing.min.js',
                'Backend/js/sb-admin-2.min.js',
                'Backend/vendor/chart.js/Chart.min.js',
                'Backend/js/demo/chart-area-demo.js',
                'Backend/js/demo/chart-pie-demo.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
                'Backend/libary/location.js',
                'Backend/plugins/ckfinder/ckfinder.js',
                'Backend/libary/finder.js',
                'Backend/plugins/datetimepicker-master/build/jquery.datetimepicker.full.js',
                'Backend/js/plugins/switchery/switchery.js',
                'Backend/libary/postCatalogue.js',
            ],
            'css' => [
                'Backend/vendor/fontawesome-free/css/all.min.css',
                'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
                'Backend/css/sb-admin-2.min.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                'Backend/plugins/datetimepicker-master/build/jquery.datetimepicker.min.css',
                'Backend/css/plugins/switchery/switchery.css',
            ],
            'model' => 'Post'
        ];
    }

    private function configCUD()
    {
        return [
            'js' => [
                'Backend/vendor/jquery/jquery.min.js',
                'Backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'Backend/vendor/jquery-easing/jquery.easing.min.js',
                'Backend/js/sb-admin-2.min.js',
                'Backend/vendor/chart.js/Chart.min.js',
                'Backend/js/demo/chart-area-demo.js',
                'Backend/js/demo/chart-pie-demo.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
                'Backend/libary/finder.js',
                'Backend/plugins/ckfinder/ckfinder.js',
                'Backend/libary/postCatalogue.js',
                'Backend/plugins/ckeditor/ckeditor.js'

            ],
            'css' => [
                'Backend/vendor/fontawesome-free/css/all.min.css',
                'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
                'Backend/css/sb-admin-2.min.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ]
        ];
    }
}
