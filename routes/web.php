<?php

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
    return view('welcome', ['website' => 'Laravel']);
});

// 测试路由View
Route::view('web/index', 'welcome', ['website' => 'Laravel']);

// 测试get路由
Route::get('test/index', function () {
    return 'this is a test page';
});

// 测试post路由
Route::post('post/test', function () {
    return 'this is a post request';
});

// 测试获取路由参数
Route::get('user/{id}', function ($id) {
    return '路由的ID为：'.$id;
});

// 测试命名路由
Route::get('test/name', function () {
    return 'this route name is:'.route('userroute');
})->name('userroute');

// 测试cookie
Route::post('cookie/test', function () {
    $minutes = 10;
    $cookie = cookie('testcookie', 'dreama', $minutes);
    return response('正在测试cookie响应')->cookie($cookie);
});

// 测试添加路由前缀
Route::prefix('mds')->group(function (){
    Route::any('test/index', 'Test\TestController@index');
});

// 测试自定义控制器方法
Route::namespace('\Test')->group(function (){
    Route::any('test/index', 'TestController@index')->name('index1_route');
    Route::any('test/general', 'TestController@general');
    Route::get('test/snowflake', 'TestController@snowflake');
});