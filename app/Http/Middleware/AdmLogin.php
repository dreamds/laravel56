<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\ApiHandler as Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AdmLogin extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @throws \Tymon\JWTAuth\Exceptions\JWTException;
     * @throws Exception
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth('admapi')->getToken()){
            throw new Exception('未提供身份验证Token');
        }
        if (!auth('admapi')->check()){
            throw new Exception('提供的Token无效');
        }
        if (!auth('admapi')->user()){
            throw new Exception('未提供身份验证Token');
        }
        return $next($request);
    }
}
