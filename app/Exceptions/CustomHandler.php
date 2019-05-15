<?php
/**
 * Created by PhpStorm.
 * User: Dreamma
 * Date: 2019/5/14
 * Time: 14:47
 */

namespace App\Exceptions;

use Exception;

class CustomHandler extends Exception
{
    /**
     * 自定义按照JSON格式进行异常返回
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        // 统一以-1作为错误码返回
        $code = $this->getCode() ? $this->getCode() : -1;
        return response()->json([
            'code' => $code,
            'msg'  => $this->getMessage()
        ]);
    }
}