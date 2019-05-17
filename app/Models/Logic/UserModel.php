<?php
/**
 * Created by PhpStorm.
 * User: Dreamma
 * Date: 2019/5/17
 * Time: 15:49
 */

namespace App\Models\Logic;

use App\Models\Dao\User;
use Illuminate\Support\Facades\Hash;

class UserModel extends BasicModel
{

    public function checkUserLogin($params = [])
    {
        // 根据账户名获取用户数据
        $user = User::query()->where('is_deleted','=',0)
            ->where('status','=',1)
            ->where('account','=',$params['account'])
            ->first();
        if (!$user){
            return false;
        }

        // 验证密码
        if (!Hash::check($params['password'], $user->password)){
            return false;
        }

        // 返回用户数据实例，供JWT使用
        return $user;
    }
}