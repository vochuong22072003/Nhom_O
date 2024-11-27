<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        // Xử lý logic khi không được xác thực
        $redirectRoute = $this->getRedirectRoute($request, $guards);

        if (!$request->expectsJson()) {
            // Redirect với thông báo
            return redirect()->route($redirectRoute)
                ->with('error', 'Vui lòng đăng nhập để sử dụng chức năng này');
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $redirectRoute
        );
    }

    /**
     * Determine the redirect route based on guards or middleware.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return string|null
     */
    protected function getRedirectRoute(Request $request, array $guards): ?string
    {
        if (in_array('web', $guards) || $request->route()->middleware() && in_array('auth:web', $request->route()->middleware())) {
            return 'auth.admin';
        }

        return 'login'; // Đường dẫn mặc định
    }
}
