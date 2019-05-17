<?php
/**
 * 后台管理错误码定义类
 * User: Dreamma
 * Date: 2019/5/17
 * Time: 14:11
 */

namespace App\Library;


class AdmError
{
    const GENERAL_ERROR    = -1;   //通用的错误代码
    const SUCCESS_CODE     = 200;  //请求响应成功
    const ARGUMENT_INVALID = 400;  //通用的请求参数无效
    const USER_AUTH        = 401;  //用户身份验证错误
    const NOT_FOUND        = 404;  //未找到请求的资源
}