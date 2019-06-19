<?php

namespace app\admin\rbac;


/**
 * 判断是否有权限的契约(接口interface)
 *
 * @package app\admin\rbac
 */
interface HasPermissionContract
{
    /**
     * 判断是否有权限
     *
     * @param $permissionName
     * @return mixed
     */
    public function has($permissionName);

    /**
     * 一次性判断多个权限
     *
     * @param array $permissionNames
     * @return array
     */
    public function moreHas(array $permissionNames);
}