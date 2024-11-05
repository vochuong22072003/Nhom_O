<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\HomeServiceInterface as HomeService;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
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
        // dd($categories);
        return view('client.index', compact('template', 'config', 'lastestNews', 'getCatalogue'));
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

        return view($template, compact('config', 'getPost'));
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
