<?php

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::guard('api')->id());
        if(Auth::guard('apiAccessUser')->id()>0){
            return redirect()->route('api.user.profile', ['model' => 'user']);
        }
        if(Auth::guard('apiAccessCustomer')->id()>0){
            return redirect()->route('api.user.profile', ['model' => 'customer']);
        }
        return $next($request);
    }
}
