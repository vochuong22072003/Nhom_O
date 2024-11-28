<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Repositories\Interfaces\HomeRepositoryInterface as HomeRepository;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Repositories\Interfaces\HomeRepositoryInterface', 'App\Repositories\HomeRepository');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('client.layouts.header', function ($view) {
            $homeRepository = $this->app->make(HomeRepository::class);
            $menus = $homeRepository->getActiveParentCategoriesWithChildren();
            foreach ($menus as $category) {
                $category->encrypted_id = $this->encryptId($category->id);
                foreach ($category->post_catalogue_children as $child) {
                    $child->encrypted_id = $this->encryptId($child->id);
                }
            }
            $view->with('menus', $menus);
        });


        /**
         *   Variable for setting
         */
        View::composer('client.account-setting-partials.*', function ($view) {
            $view->with([
                'cus' => auth('customers')->user(),
                'cusInfo' => auth('customers')->user()->customerInfo
            ]);
        });

        View::composer('client.layouts.sidebar', function ($view) {
            $homeRepository = $this->app->make(HomeRepository::class);
            $posts_view = $homeRepository->getPostByView();
            $view->with('posts_view', $posts_view);
        });
    }
    public function encryptId($id)
    {
        $salt = "chuoi_noi_voi_id";
        return base64_encode($id . $salt);
    }
}
