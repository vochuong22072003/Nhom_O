<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Repositories\Interfaces\HomeRepositoryInterface as  HomeRepository;

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
    }
    public function encryptId($id) {
        $salt = "chuoi_noi_voi_id";
        return base64_encode($id . $salt);
    }
}
