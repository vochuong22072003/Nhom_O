<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\API\LoginApiMiddleware;
use App\Http\Middleware\API\AuthenticateApiMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/create', [AuthController::class, 'create'])->name('api.create');
Route::get('/index', [AuthController::class, 'index'])->name('api.index');

Route::get('/{model}/data', [AuthController::class, 'getModelData'])->middleware(AuthenticateApiMiddleware::class)->name('api.data');
Route::get('/protected-route', [AuthController::class, 'protectedRoute'])->name('api.protected-route');
Route::get('/user/login', [AuthController::class, 'login'])->middleware(LoginApiMiddleware::class)->name('api.user.login');
Route::post('/user/auth', [AuthController::class, 'auth'])->name('api.user.auth');
Route::get('/user/profile/{model}', [AuthController::class, 'profile'])->middleware(AuthenticateApiMiddleware::class)->name('api.user.profile');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('api.user.logout');