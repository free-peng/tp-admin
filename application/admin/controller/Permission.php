<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Permission as PermissionModel;
use think\facade\Request;
use app\admin\model\PermissionGroup;
use think\facade\Db;

class Permission extends Base
{
//    protected $middleware = ['Permission'];

    public function index()
    {
        //查询所有权限
       $permissonList = PermissionModel::select();

        $this->view->assign('permissionList', $permissonList);
        $this->view->assign('num', 1);
        return $this->view->fetch('index');
    }

    /**
     * 渲染权限添加页面
     * @return string
     * @throws \Exception
     */
    public function create()
    {
        //查询权限组
        $groups = PermissionGroup::select();
        $this->view->assign('groups', $groups);

        return $this->view->fetch('create');
    }

    /**
     * 保存新增权限
     */
    public function save()
    {
        $data = Request::param();

        $rule = [
            'show_name|权限名称' => 'require',
            'group_id|权限组' => 'require'
        ];
        $res =  $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

//        判断权限是否存在
        if (PermissionModel::where('name', $data['name'])->find()) {
            return $this->error('权限名称已经存在');
        }

        $data['name'] = strtolower($data['name']);
        return PermissionModel::create($data)
            ? $this->success('添加成功', 'admin/permission/index')
            : $this->error('添加失败');

    }

    /**
     * 删除权限
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return PermissionModel::destroy($id)
            ? ['status'=>1,'message'=>'删除成功']
            : ['status'=>0,'message'=>'删除失败'];
    }

    /**
     * 查询权限名称
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function selectPermission($id)
    {
        $permission = PermissionModel::where('id', $id)->find();

        return ['show_name' => $permission['show_name'],'name'=>$permission['name']];
    }

    public function doEdit()
    {
        $data = Request::param();

        $rule = ['name|权限名称' => 'require'];
        $res =  $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

        $data['name'] = strtolower($data['name']);
        return PermissionModel::where('id', $data['id'])->update($data)
            ? $this->success('编辑成功', 'admin/permission/index')
            : $this->error('编辑失败(没有修改)');

    }

}