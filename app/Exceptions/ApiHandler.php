<?php
/**
 * Created by PhpStorm.
 * User: Dreamma
 * Date: 2019/5/14
 * Time: 14:47
 */

namespace App\Exceptions;

use Exception;
use App\Library\AdmError;

class ApiHandler extends Exception
{
    /**
     * 自定义API异常信息返回
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        // 以-1作为错误码缺省值，可自定义错误码（0除外）
        $code = $this->getCode() ? $this->getCode() : AdmError::GENERAL_ERROR;
        return response()->json([
            'code' => $code,
            'msg'  => $this->getMessage(),
            'time' => microtime(true)
        ]);
    }
}