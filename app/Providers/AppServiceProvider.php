<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    protected $serviceBindings = [


        'App\Services\Interfaces\PostCatalogueParentServiceInterface' => 'App\Services\PostCatalogueParentService',
        'App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface' => 'App\Repositories\PostCatalogueParentRepository',

        'App\Services\Interfaces\PostServiceInterface' => 'App\Services\PostService',
        'App\Repositories\Interfaces\PostRepositoryInterface' => 'App\Repositories\PostRepository',


        'App\Services\Interfaces\PostCatalogueChildrenServiceInterface' => 'App\Services\PostCatalogueChildrenService',
        'App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface' => 'App\Repositories\PostCatalogueChildrenRepository',


        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',

        'App\Services\Interfaces\UserCatalogueServiceInterface' => 'App\Services\UserCatalogueService',
        'App\Repositories\Interfaces\UserCatalogueRepositoryInterface' => 'App\Repositories\UserCatalogueRepository',

        'App\Services\Interfaces\UserInfoServiceInterface' => 'App\Services\UserInfoService',
        'App\Repositories\Interfaces\UserInfoRepositoryInterface' => 'App\Repositories\UserInfoRepository',

        'App\Repositories\Interfaces\ProvinceRepositoryInterface' => 'App\Repositories\ProvinceRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface' => 'App\Repositories\DistrictRepository',
        'App\Repositories\Interfaces\WardRepositoryInterface' => 'App\Repositories\WardRepository',

        'App\Services\Interfaces\PermissionServiceInterface' => 'App\Services\PermissionService',
        'App\Repositories\Interfaces\PermissionRepositoryInterface' => 'App\Repositories\PermissionRepository',


        //client
        'App\Services\Interfaces\HomeServiceInterface' => 'App\Services\HomeService',
        'App\Repositories\Interfaces\HomeRepositoryInterface' => 'App\Repositories\HomeRepository',

        'App\Services\Interfaces\CommentServiceInterface' => 'App\Services\CommentService',
        'App\Repositories\Interfaces\CommentRepositoryInterface' => 'App\Repositories\CommentRepository',
    ];

    /**
     * Bootstrap any application services.
     */
    public function register(): void
    {
        foreach ($this->serviceBindings as $key => $val) {
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Password::defaults(function () {
            return Password::min(8) 
                ->mixedCase()        
                ->letters()          
                ->numbers()          
                ->symbols();
        });
    }
}
