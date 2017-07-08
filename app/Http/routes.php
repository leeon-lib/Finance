<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/
Route::auth();

Route::get('/', 'IndexController@index');

Route::get('/home', 'HomeController@home');
Route::get('/dashboard', 'HomeController@dashboard');

// 菜单管理
Route::group(['prefix' => '/memus'], function () {
    Route::get('/', 'MemuController@index');
});
