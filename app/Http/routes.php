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
        Route::get('/add', 'MemuController@showAdd');
        Route::get('/edit', 'MemuController@showEdit');
        Route::post('/add', 'MemuController@add');

        Route::model('memu_id', 'App\Models\Memu');
        Route::get('/{memu_id?}', 'MemuController@index');
    });

    // 用户管理
    Route::group(['prefix' => '/users'] ,function () {
        Route::get('/', 'UserController@index');
    });
});
