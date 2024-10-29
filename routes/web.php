<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\UserCatalogueController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PostCatalogueParentController;
use App\Http\Controllers\Backend\PostCatalogueChildrenController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Ajax\PostCatalogueController;

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);
Route::get('admin', [AuthController::class, 'index'])->name('auth.admin')->middleware(LoginMiddleware::class);
Route::post('admin/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth:web'])->group(function () {
    Route::group(['prefix' => 'user/profile'], function () {
        Route::get('edit', [DashboardController::class, 'edit'])->name('user.profile.edit')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
        Route::post('update', [DashboardController::class, 'update'])->name('user.profile.update')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
    });
    Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.getLocation')->middleware(AuthenticateMiddleware::class);
    Route::group(['prefix' => 'user/catalogue'], function () {
        Route::get('index', [UserCatalogueController::class, 'index'])->name('user.catalogue.index')->middleware(AuthenticateMiddleware::class);
        Route::get('store', [UserCatalogueController::class, 'store'])->name('user.catalogue.store')->middleware(AuthenticateMiddleware::class);
        Route::post('create', [UserCatalogueController::class, 'create'])->name('user.catalogue.create')->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/edit', [UserCatalogueController::class, 'edit'])->name('user.catalogue.edit')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/update', [UserCatalogueController::class, 'update'])->name('user.catalogue.update')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/destroy', [UserCatalogueController::class, 'destroy'])->name('user.catalogue.destroy')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/delete', [UserCatalogueController::class, 'delete'])->name('user.catalogue.delete')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
        Route::get('permission', [UserCatalogueController::class, 'permission'])->name('user.catalogue.permission')->where(['id' => '[0-9]+']);
        Route::post('updatePermission', [UserCatalogueController::class, 'updatePermission'])->name('user.catalogue.updatePermission')->where(['id' => '[0-9]+']);
    });
    Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');
    Route::group(['prefix' => 'user'], function () {
        Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware(AuthenticateMiddleware::class);
        Route::get('store', [UserController::class, 'store'])->name('user.store')->middleware(AuthenticateMiddleware::class);
        Route::post('create', [UserController::class, 'create'])->name('user.create')->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/update', [UserController::class, 'update'])->name('user.update')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/delete', [UserController::class, 'delete'])->name('user.delete')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
    });
    Route::group(['prefix' => 'permission'], function () {
        Route::get('index', [PermissionController::class, 'index'])->name('permission.index')->middleware(AuthenticateMiddleware::class);
        Route::get('store', [PermissionController::class, 'store'])->name('permission.store')->middleware(AuthenticateMiddleware::class);;
        Route::post('create', [PermissionController::class, 'create'])->name('permission.create')->middleware(AuthenticateMiddleware::class);;
        Route::get('{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit')->middleware(AuthenticateMiddleware::class);;
        Route::post('{id}/update', [PermissionController::class, 'update'])->name('permission.update')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);;
        Route::get('{id}/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy')->middleware(AuthenticateMiddleware::class);;
        Route::post('{id}/delete', [PermissionController::class, 'delete'])->name('permission.delete')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);;
    });
    // == Post catalogue parent Nghĩa
    Route::group(['prefix' => 'post/catalogue/parent'], function () {
        Route::get('index', [PostCatalogueParentController::class, 'index'])->name('post.catalogue.parent.index')->middleware(AuthenticateMiddleware::class);
        Route::get('store', [PostCatalogueParentController::class, 'store'])->name('post.catalogue.parent.store')->middleware(AuthenticateMiddleware::class);
        Route::post('create', [PostCatalogueParentController::class, 'create'])->name('post.catalogue.parent.create')->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/edit', [PostCatalogueParentController::class, 'edit'])->name('post.catalogue.parent.edit')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/update', [PostCatalogueParentController::class, 'update'])->name('post.catalogue.parent.update')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/destroy', [PostCatalogueParentController::class, 'destroy'])->name('post.catalogue.parent.destroy')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/delete', [PostCatalogueParentController::class, 'delete'])->name('post.catalogue.parent.delete')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
    });

    // == Post catalogue chilren Nghĩa
    Route::group(['prefix' => 'post/catalogue/children'], function () {
        Route::get('index', [PostCatalogueChildrenController::class, 'index'])->name('post.catalogue.children.index')->middleware(AuthenticateMiddleware::class);
        Route::get('store', [PostCatalogueChildrenController::class, 'store'])->name('post.catalogue.children.store')->middleware(AuthenticateMiddleware::class);
        Route::post('create', [PostCatalogueChildrenController::class, 'create'])->name('post.catalogue.children.create')->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/edit', [PostCatalogueChildrenController::class, 'edit'])->name('post.catalogue.children.edit')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/update', [PostCatalogueChildrenController::class, 'update'])->name('post.catalogue.children.update')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/destroy', [PostCatalogueChildrenController::class, 'destroy'])->name('post.catalogue.children.destroy')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/delete', [PostCatalogueChildrenController::class, 'delete'])->name('post.catalogue.children.delete')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
    });

    // == Posts Nghĩa
    Route::group(['prefix' => 'post'], function () {
        Route::get('index', [PostController::class, 'index'])->name('post.index')->middleware(AuthenticateMiddleware::class);
        Route::get('store', [PostController::class, 'store'])->name('post.store')->middleware(AuthenticateMiddleware::class);
        Route::post('create', [PostController::class, 'create'])->name('post.create')->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('post.edit')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/update', [PostController::class, 'update'])->name('post.update')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/delete', [PostController::class, 'delete'])->name('post.delete')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
    });
    Route::get('ajax/postCatalogue/getPostCatalogue',[PostCatalogueController::class, 'getPostCatalogue'])->name('ajax.postCatalogue.getPostCatalogue')->middleware(AuthenticateMiddleware::class);
});


Route::name('client.')->group(function () {
    Route::get('/', function () {
        return view('client.index');
    })->name('home');

    Route::get('/about', function () {
        return view('client.about');
    })->name('about');
 
    Route::get('/blog-grid', function () {
        return view('client.blog-grid');
    })->name('blog-grid');

    Route::get('/detail', function () {
        return view('client.detail');
    })->name('detail');

    Route::get('/category', function () {
        return view('client.category');
    })->name('category');
    
    Route::get('/contact', function () {
        return view('client.contact');
    })->name('contact');

    Route::get('/blog-list', function () {
        return view('client.blog-list');
    })->name('blog-list');
});

require __DIR__.'/auth.php';