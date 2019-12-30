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
    Route::get('/me', 'AuthController@me');
    Route::apiResource('/blog', 'Blog\BlogController');
});
