<?php

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('apiAccessUser')->id()==null && Auth::guard('apiAccessCustomer')->id()==null){
            // return redirect()->route('api.user.login')->with('error','Vui lòng đăng nhập để sử dụng chức năng này');
            return redirect()->route('api.user.login');
        }
        return $next($request);
    }
}
