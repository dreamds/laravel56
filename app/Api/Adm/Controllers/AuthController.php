<?php
/**
 * 用户身份权限控制器
 * User: Dreamma
 * Date: 2019/5/16
 * Time: 14:53
 */

namespace App\Api\Adm\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Library\AdmError;
use App\Exceptions\ApiHandler as Exception;
use App\Models\Logic\UserModel;

class AuthController extends BaseController
{
    /**
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     * @return mixed
     */
    public function login(Request $request)
    {
        // 请求参数验证
        $validator = Validator::make($request->all(), [
            'account'  => 'required|max:20',
            'password' => 'required|max:32',
        ]);
        if ($validator->fails()){
            throw new Exception('请求参数有误', AdmError::ARGUMENT_INVALID);
        }

        // 验证用户身份信息，创建Jwt身份Token
        $account  = $request->input('account');
        $password = $request->input('password');
        $user = (new UserModel())->checkUserLogin(['account'=>$account,'password'=>$password]);

        // 身份验证通过，生成Token并返回
        $token = auth('admapi')->login($user);
        return $this->respondWithToken($token);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function logout(Request $request)
    {
        $user = auth('admapi')->user();
        toprint($user);
        auth('admapi')->logout();
        return ['data'=>null, 'msg'=>'ok', 'code'=>AdmError::SUCCESS_CODE];
    }

    /**
     * Get the token array structure.
     * @param  string $token
     */
    protected function respondWithToken($token)
    {
        $aa = [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('admapi')->factory()->getTTL() * 60
        ];
        toprint($aa);
    }
}
