<?php

namespace app\admin\controller;

use app\admin\model\Menu as MenuModel;
use app\admin\presenter\MenuPresenter;
use app\admin\model\Permission;
use think\facade\Request;
use think\facade\Session;

class Menu extends Base
{
//    protected $middleware = ['Permission'];

    public  function index(){
        $menus = MenuModel::select();

        $this->assign("menus", $menus);
        return $this->fetch("index");
    }

    public function create(MenuPresenter $presenter)
    {
        //查询出所有的权限
        $permissions = Permission::select();

        $this->getUserName();
        $this->view->assign('permissions', $permissions);
        $this->view->assign('num', 1);
        $this->view->assign('menuPresenter', $presenter);
        return $this->view->fetch("create");
    }

    public function store()
    {
        $data = Request::param();

        $rule = [
            'name|菜单名称' => 'require',
        ];
        $res = $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

        return MenuModel::create($data)
            ? $this->success('添加成功', 'admin/menu/index')
            : $this->error('添加失败');
    }

    public function edit(MenuPresenter $presenter)
    {
        $id = Request::param('id');

        //查询出用户当前所属的权限
        $menuPermission = Db('menus')
            ->alias('m')
            ->join('permissions p', 'm.permission_name = p.name')
            ->where('m.id', $id)
            ->field('m.permission_name')
            ->find();
        $this->view->assign('menuPermission',$menuPermission['permission_name']);

        //查询出所有权限
        $permissions = Permission::select();
        $this->view->assign('permissions', $permissions);
        //查询菜单信息
        $data = MenuModel::where('id', $id)->find();
        $this->view->assign('menu', $data);

        $this->view->assign('menuPresenter', $presenter);
        $this->view->assign('id', $id);

        return $this->view->fetch('edit');

    }

    public function saveEdit()
    {
        $data = Request::param();
        $rule = [
            'name|菜单名称' => 'require',
        ];
        $res = $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

        return MenuModel::where('id', $data['id'])->update($data)
            ? $this->success('修改成功','admin/menu/index')
            : $this->error('修改失败');
    }

    public function delete($id)
    {
        return MenuModel::destroy($id)
            ? $this->success('删除成功', 'admin/menu/index')
            : $this->error('保存失败');
    }
}