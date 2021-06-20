<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/myMemo', 'Api\PostController@myMemo');
    Route::post('/updateUserName', 'Api\UserController@updateUserName');
    Route::post('/updateUserEmail', 'Api\UserController@updateUserEmail');
});

Route::group(["middleware" => "admin"], function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/current_admin_user', function () {
        return Auth::guard('admin')->user();
    });

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::apiResource('admin_users', 'Api\AdminUserController')->except(['show']);
    });
});

Route::resource('/categories', 'Api\CategoryController');
Route::resource('/posts', 'Api\PostController');
Route::resource('/users', 'Api\UserController');
