<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\debugController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\NotificationController;
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

use App\Http\Controllers\Frontend\HomeController;

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Ajax\CommentController as AjaxCommentController;
use App\Http\Controllers\ElasticsearchController;
use App\Http\Controllers\LikeView\ViewController;
use App\Http\Controllers\LikeView\LikeController;
use App\Http\Controllers\LikeView\SaveController;
use App\Http\Controllers\LikeView\SaveFolderController;
use App\Http\Controllers\LikeView\TagController;
use Elastic\Elasticsearch\Response\Elasticsearch;

require __DIR__ . '/auth.php';

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);
Route::get('admin', [AuthController::class, 'index'])->name('auth.admin')->middleware(LoginMiddleware::class);
Route::post('admin/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => ['auth:web']], function (){
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
    Route::post('ajax/dashboard/changeStatusAll',[AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll');
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
        Route::get('store', [PermissionController::class, 'store'])->name('permission.store')->middleware(AuthenticateMiddleware::class);
        Route::post('create', [PermissionController::class, 'create'])->name('permission.create')->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/update', [PermissionController::class, 'update'])->name('permission.update')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
        Route::get('{id}/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy')->middleware(AuthenticateMiddleware::class);
        Route::post('{id}/delete', [PermissionController::class, 'delete'])->name('permission.delete')->where(['id' => '[0-9]+'])->middleware(AuthenticateMiddleware::class);
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
        Route::post('{id}/addtag', [PostController::class, 'index'])->name('post.addtag')->middleware(AuthenticateMiddleware::class);
        //Route::get('liked-posts', [PostController::class, 'getLikedPosts'])->name('post.liked')->middleware(AuthenticateMiddleware::class);
        //Route::get('/search', [PostController::class, 'search'])->name('posts.search');


    });
    Route::get('ajax/postCatalogue/getPostCatalogue', [PostCatalogueController::class, 'getPostCatalogue'])->name('ajax.postCatalogue.getPostCatalogue')->middleware(AuthenticateMiddleware::class);
});

// Võ Tiến Chương
Route::get('/check-login', function () {
    return response()->json(['loggedIn' => auth()->check()]);
});

// Võ Tiến Chương Comment Function
Route::group(['prefix' => 'comment'], function () {
    Route::post('create', [CommentController::class, 'create'])->name('comment.create');
});
Route::post('ajax/comment/reply', [AjaxCommentController::class, 'createReply'])->name('ajax.comment.reply');
Route::get('ajax/comment/showReply', [AjaxCommentController::class, 'showReply'])->name('ajax.comment.showReply');
Route::post('ajax/comment/replyN', [AjaxCommentController::class, 'createReplyN'])->name('ajax.comment.replyN');
Route::post('ajax/comment/update', [AjaxCommentController::class, 'update'])->name('ajax.comment.update');
Route::post('ajax/comment/updateN', [AjaxCommentController::class, 'updateN'])->name('ajax.comment.updateN');
Route::get('ajax/comment/delete', [AjaxCommentController::class, 'delete'])->name('ajax.comment.delete');
Route::get('ajax/comment/deleteN', [AjaxCommentController::class, 'deleteN'])->name('ajax.comment.deleteN');

Route::name('client.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('{id}/{model}/category', [HomeController::class, 'category'])->name('category');
    Route::get('{id}/detail', [HomeController::class, 'detail'])->name('detail');
    Route::get('/myactive',[HomeController::class,'myactives'])->name('myactive');
    Route::get('/sync-elasticsearch', [ElasticsearchController::class, 'syncDataToElasticsearch']);
    Route::post('/search', [ElasticsearchController::class, 'search'])->name('search');
    Route::get('/tag/{tagId}', [HomeController::class,'tagPostResult'])->name('tag.posts');
});

// các route liên quan đến post và like view tags khiêm
Route::prefix('posts')->group(function () {
    Route::post('/increment-view', [ViewController::class, 'incrementViewCount'])->name('incrementView');
    Route::post('/like', [LikeController::class, 'getLike'])->name('posts.like');
    Route::post('/liked-posts', [LikeController::class, 'getLikedPosts'])->name('liked-posts.index');
    
});
// Group cho các route liên quan đến lưu vào danh mục và tạo danh mục Khiêm
Route::prefix('folder')->group(function () {
    Route::post('/create-folder', [SaveFolderController::class, 'getSave'])->name('create-folder');
    Route::post('/saveToFolder', [SaveFolderController::class, 'savePostToFolder'])->name('posts.saveToFolder');
    Route::delete('/{folderId}', [SaveFolderController::class, 'deteleFolder'])->name('folders.delete');
    Route::delete('{folderId}/posts/{postId}', [SaveFolderController::class, 'detelePostFromFolder'])->name('folders.posts.delete');
});

//Route::get('/tag/{tagId}', [TagController::class,'tagPostResult'])->name('tag.posts');

/*
|--------------------------------------------------------------------------
| Routes for Customer Setting
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    Route::name('setting.')->group(function () {
        Route::get('/account_general', [AccountController::class, 'edit'])->name('general');
        Route::patch('/account_general', [AccountController::class, 'update'])->name('general-update');

        Route::get('/account_info', [PersonalInfoController::class, 'edit'])->name('account-info');
        Route::patch('/account_info', [PersonalInfoController::class, 'update'])->name('account-info-update');
        
        Route::get('/account_change_password', [AccountController::class, 'changePassword'])->name('change-password');
        //Route::put (password.update) from ./routes/auth.php

        Route::get('/account_notifications', [NotificationController::class, 'edit'])->name('notifications');
    });
});

Route::post('/follow', FollowController::class)->middleware('auth')->name('follow');

