<?php

namespace app\http\middleware;

use app\admin\rbac\HasPermission;

class Permission
{
    public function handle($request, \Closure $next)
    {
        $router = $request->module() ."/" . $request->controller() . "/" . $request->action();

        $hasPermission = new HasPermission();

//        halt($hasPermission->has($router));
        if ($hasPermission->has($router)) {
            return $next($request);
        }

        if ($request->isAjax()) {
            return json(['message' => '你没有权限访问' . $router, 'status_code' => 401]);
        }

//        return redirect('test/index');
        dump("No Permission");

        return $next($request);
    }
}
