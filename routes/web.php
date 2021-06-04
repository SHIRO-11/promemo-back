<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::get('/', function (){
    return 'piyopiyo';
});

Route::get('/user', function (){
    Log::debug(Auth::user());
    return Auth::user();
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
