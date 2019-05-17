<?php
/**
 * 通用的工具方法
 * User: Dreamma
 * Date: 2019/5/17
 * Time: 15:07
 */

/**
 * 格式化打印调试变量print_r,自动断点
 */
if (!function_exists('todump')) {
    function todump()
    {
        $params = func_get_args();
        call_user_func_array('var_dump', $params);die;
    }
}

/**
 * 格式化打印调试变量print_r,自动断点
 */
if (!function_exists('toprint')) {
    function toprint()
    {
        $params = func_get_args();
        call_user_func_array('print_r', $params);die;
    }
}

/**
 * 格式化打印调试变量print_r,自动断点
 */
if (!function_exists('flushJson')) {
    function flushJson($data, $message='', $code=\App\Library\AdmError::SUCCESS_CODE)
    {
        return response()->json([
            'data'    => $data,
            'msg'     => $message,
            'code'    => $code,
            'time'    => microtime(true),
        ]);
    }
}