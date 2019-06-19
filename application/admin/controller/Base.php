<?php

namespace app\admin\controller;

use think\Controller;
use think\facade\Session;
use app\admin\model\PermissionGroup;
use app\admin\model\Permission;
use think\Db;


class Base extends Controller
{
   protected $middleware = ['Auth', 'Permission'];

    /**
     * 出示化方法
     */
    protected function initialize()
    {
        $this->displayMenu();
    }

    /**
     * 查出权限组
     */
    public function getRightsGroups()
    {
        //查询出权限组
        $rightsGroups = PermissionGroup::select();

        $groupIds = $rightsGroups->column('id');

        $rightsGroupsList = [];
        Permission::whereIn('group_id',$groupIds)
            ->select()
            ->map(function ($item) use (&$rightsGroupsList){
                $rightsGroupsList[$item['group_id']][] = $item->toArray();
            });
        return $this->view->assign('rightGroupsList', $rightsGroupsList);
    }

    /**
     * 获取用户名字
     * @return \think\View
     */
    public function getUserName()
    {
        return $this->view->assign('userName', Session::get('name'));
    }


    public function displayMenu()
    {
        //获取用户id
        $userId = Session::get('user_id');

        //多表查询出用户的菜单权限
        $userMenu = Db('user_role')
            ->alias('ur')
            ->join('role_permission rp','ur.role_id=rp.role_id')
            ->join('permissions p', 'rp.permission_id = p.id')
            ->join('menus m', 'p.name = m.permission_name')
            ->where('ur.user_id', $userId)
            ->field('m.*')
            ->select();

        return $this->view->assign('userMenu',$userMenu);
    }
}