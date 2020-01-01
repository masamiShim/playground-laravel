<?php

use App\Http\Controllers\Base\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::group(['middleware' => 'auth:api'], function () {
    // 認証関連
    Route::get('/me', 'AuthController@me');
    Route::post('/refresh', 'AuthController@refresh');

    // Blog
    // blog
    Route::apiResource('/blog', 'Blog\BlogController');
    Route::apiResource('/like/blog', 'Blog\BlogLikeController');
    Route::apiResource('/favorite/blog', 'Blog\BlogFavoriteController');
    // post
    Route::apiResource('/post', 'Blog\PostController');
    Route::apiResource('/like/post', 'Blog\BlogLikeController');
    Route::apiResource('/favorite/post', 'Blog\BlogFavoriteController');
    // comment
    Route::apiResource('/comment', 'Blog\CommentController');

    // other
    Route::get('/my/blog', 'Blog\BlogController@myBlog');
    Route::get('/detail/blog/{id}', 'Blog\BlogController@showDetail');

});
