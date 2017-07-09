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

// 系统设置
Route::group(['namespace' => 'Settings', 'prefix' => '/settings'], function () {
    // 菜单管理
    Route::group(['prefix' => '/memus'] ,function () {
        Route::get('/', 'MemuController@index');
        Route::get('/add', 'MemuController@showAdd');
        Route::get('/edit', 'MemuController@showEdit');
    });
});
