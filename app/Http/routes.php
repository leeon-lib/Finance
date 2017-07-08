<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/
Route::auth();
Route::any('/register', function () {
    App::abort(404);
});

Route::get('/', 'IndexController@index');
Route::get('/home', 'HomeController@home');
Route::get('/dashboard', 'HomeController@dashboard');

// 菜单管理
Route::group(['namespace' => 'Settings', 'prefix' => '/settings'], function () {
    Route::get('/memus', 'MemuController@index');
    Route::get('/add', 'MemuController@add');
});
