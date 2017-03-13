<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::auth(); // RESTFUL Controller -> getChinhSua --> chinh-sua

//Route::get('/home', 'HomeController@index');

// Middleware de quan ly nguoi dung truy cap vao trang cu the
Route::get('/home', [
    'middleware' => ['auth', 'roles'], // A 'roles' middleware must be specified
    'uses' => 'HomeController@index',
    'roles' => ['administrator', 'manager'] // Only an administrator, or a manager can access this route
]);

// Đến trang tĩnh dựa vào slug (đây là các khác ngắn gọn để đến trang)
Route::get('page/{slug}', ['as' => 'page', 'uses' => 'PageController@page']);

// admin
Route::group(['prefix' => 'admin'], function () {

    Route::get('dashboard', function () {
        return view('admin.dashboard.main');
    });

    Route::group([
        'prefix' => 'cate'
    ],
        function () {
            Route::get('index', ['as' => 'getCateIndex', 'uses' => 'CategoryController@getIndex']);
            Route::get('add', ['as' => 'getCateAdd', 'uses' => 'CategoryController@getAdd']);
            Route::post('add', ['as' => 'postCateAdd', 'uses' => 'CategoryController@postAdd']);
            Route::get('edit/{id}', ['as' => 'getCateEdit', 'uses' => 'CategoryController@getEdit']);
            Route::post('edit/{id}', ['as' => 'postCateEdit', 'uses' => 'CategoryController@postEdit']);
            Route::get('delete/{id}', ['as' => 'getCateDelete', 'uses' => 'CategoryController@getDelete']);
        });

    Route::group([
        'prefix' => 'user',
        'middleware' => ['auth', 'roles'],
        'roles' => ['administrator']
    ],
        function () {
            Route::get('index', ['as' => 'getUserIndex', 'uses' => 'UserController@getIndex']);
            Route::get('add', ['as' => 'getUserAdd', 'uses' => 'UserController@getAdd']);
            Route::post('add', ['as' => 'postUserAdd', 'uses' => 'UserController@postAdd']);
            Route::get('edit/{id}', ['as' => 'getUserEdit', 'uses' => 'UserController@getEdit']);
            Route::post('edit/{id}', ['as' => 'postUserEdit', 'uses' => 'UserController@postEdit']);
            Route::get('delete/{id}', ['as' => 'getUserDelete', 'uses' => 'UserController@getDelete']);
        });

    Route::group([
        'prefix' => 'news',
        'middleware' => ['auth', 'roles', 'canCate:postNewsAdd,postNewsEdit'],
        'roles' => ['administrator', 'user']
    ],
        function () {
            Route::get('index', ['as' => 'getNewsIndex', 'uses' => 'NewsController@getIndex']);
            Route::get('add', ['as' => 'getNewsAdd', 'uses' => 'NewsController@getAdd']);
            Route::post('add', ['as' => 'postNewsAdd', 'uses' => 'NewsController@postAdd']);
            Route::get('edit/{id}', ['as' => 'getNewsEdit', 'uses' => 'NewsController@getEdit']);
            Route::post('edit/{id}', ['as' => 'postNewsEdit', 'uses' => 'NewsController@postEdit']);
            Route::get('delete/{id}', ['as' => 'getNewsDelete', 'uses' => 'NewsController@getDelete']);
        });
});

// Đến trang tạo menu Đa cấp
Route::get('menu', function () {
    return view('menu');
});
