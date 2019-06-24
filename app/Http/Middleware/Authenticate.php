<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Exceptions\AuthorizeException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Authenticate
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('admin')->check()) {
            throw new AuthorizeException('Unable to authenticate with invalid API key and token.');
        }

        //路由鉴权
        if(!Auth::guard('admin')->user()->checkPermission(app('Dingo\Api\Routing\Router')->currentRouteName())) {
            throw new AccessDeniedHttpException('Unauthorized access.');
        }

        return $next($request);
    }
}
