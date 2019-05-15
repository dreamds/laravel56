<?php
/**
 * Created by PhpStorm.
 * User: Dreamma
 * Date: 2019/5/14
 * Time: 18:10
 */

namespace App\Models\Logic;

use Illuminate\Database\Eloquent\Model;

class BasicModel extends Model
{
    /**
     * 单行查询数据转数组（处理null使用toArray()时报错）
     * @param $data
     */
    protected static function firstToArray(&$data)
    {
        if (!$data){
            $data = [];
        } else {
            $data = self::object2array($data);
        }
    }

    /**
     * 对象转数组
     * @param  $obj
     * @return mixed
     */
    public static function object2array($obj) {
        return json_decode(json_encode($obj),true);
    }
}