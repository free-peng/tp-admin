<?php

namespace app\http\middleware;

use think\facade\Session;

class Auth
{
    public function handle($request, \Closure $next)
    {
        $user = Session::get('user_id');
        if (!$user) {
            return redirect('Auth/login');
        }

        return $next($request);
    }
}
