<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\HomeServiceInterface as HomeService;
use App\Models\Post;
class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
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

        foreach ($results as $cate) {
            foreach ($cate as $post) {
                $post->encrypted_id = $this->encryptId($post->id);
            }
        }     
        return view('client.index', compact('template', 'config', 'lastestNews', 'getCatalogue', 'results', 'posts'));
    }
    public function getPostLike()
    {
        $posts = Post::withCount('likes')
            ->having('likes_count', '>=', 2)
            ->orderBy('likes_count', 'desc')
            ->take(6)->get();

        return $posts;
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

        return view($template, compact('config', 'getPost'));
    }
    
    public function search(Request $request) {
        $template = 'client.search-result';
        $config = $this->config();

     

        $requestInput = $request->input('search');
        $results = $this->homeService->getPostsBySearch($requestInput);
        foreach ($results as $result) {
            $result->encrypted_id = $this->encryptId($result->id);
        }
        
        // dd($results);

        return view($template, compact('config','results'));
    }
    
    public function myactives()
    {
        $config = $this->config();
        return view('client.myactive', compact('config'));
    }
    private function config()
    {
        return [
            'js' => [
                'client/vendor/jquery/jquery-3.2.1.min.js',
                'client/vendor/animsition/js/animsition.min.js',
                'client/vendor/bootstrap/js/popper.js',
                'client/vendor/bootstrap/js/bootstrap.min.js',
                'client/js/main.js'
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
