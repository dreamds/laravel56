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

// 测试自定义控制器方法
Route::namespace('\Test')->group(function (){
    Route::any('test/index', 'TestController@index')->name('index1_route');
    Route::any('test/general', 'TestController@general');
    Route::get('test/snowflake', 'TestController@snowflake');
});