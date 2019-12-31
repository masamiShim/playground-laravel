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

Route::group(['middleware' => 'auth:api'], function () {
    // 認証関連
    Route::get('/me', 'AuthController@me');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');

    // Blog
    Route::apiResource('/blog', 'Blog\BlogController');
    Route::apiResource('/post', 'Blog\PostController');
    Route::apiResource('/comment', 'Blog\CommentController');
});
