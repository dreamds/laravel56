<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//后台管理业务API路由
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group([
        'namespace'  => '\App\Api\Adm\Controllers',
        'prefix'     => 'adm',
        'middleware' => ['api.throttle'],  //限速中间件（同IP每分钟100次）
        'limit'      => 100,
        'expires'    => 1,
    ], function ($api) {
        //====无需验证用户身份的路由====
        //用户登录，
        $api->post('auth/login', 'AuthController@login');

        //====需要验证用户身份的路由====
        $api->group([
            'middleware' => ['adm.login']
        ], function ($api) {
            //--------用户身份信息相关---------
            //刷新用户Token
            $api->post('auth/refresh', 'AuthController@refresh');
            //用户登出
            $api->post('auth/logout', 'AuthController@logout');
            //获取用户信息
            $api->get('user/userinfo', 'UserController@userinfo');

            //---------站点系统相关-----------

            //---------设备管理相关-----------
        });
    });
});