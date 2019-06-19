<?php

namespace app\admin\rbac;


use app\admin\model\AdminUser;
use think\facade\Cache;
use think\facade\Session;

class HasPermission implements HasPermissionContract
{
    protected $userId;

    public function __construct($userId = 0)
    {
        $this->userId = $userId ? $userId : Session::get('user_id');
    }

    /**
     * 判断用户是否存在需要检查的权限
     *
     * @param $permissionName
     * @return mixed
     */
    public function has($permissionName)
    {
        $cacheKey = 'user:'.$this->userId.':permission:'.$permissionName;
        return Cache::remember($cacheKey, function () use ($permissionName) {
            return (bool)AdminUser::join("user_role", 'admin_users.id=user_role.user_id')
                ->join("role_permission", 'user_role.role_id=role_permission.permission_id')
                ->join("permissions", 'role_permission.permission_id=permissions.id')
                ->where("admin_users.id", $this->userId)
                ->where("permissions.name", $permissionName)
                ->count();
        }, 5000);
    }

    public function moreHas(array $permissionNames)
    {
        $result = [];

        foreach ($permissionNames as $permissionName) {
            $result[$permissionName] = $this->has($permissionName);
        }

        return $result;
    }
}