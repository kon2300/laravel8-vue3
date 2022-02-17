<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/articles', ArticleController::class);

    Route::apiResource('articles.favorites', FavoriteController::class)
        ->only('destroy', 'store');

    Route::apiResource('articles.comments', CommentController::class)
        ->only('destroy', 'store');

    Route::apiResource('articles.likes', CommentLikeController::class)
        ->only('destroy', 'store');

    Route::resource('/users', UserController::class);

    Route::apiResource('users.follows', FollowController::class)
        ->only('destroy', 'store');
});
