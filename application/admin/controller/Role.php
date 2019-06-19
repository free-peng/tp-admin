<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Role as RoleModel;
use app\admin\model\RolePermission;
use app\admin\model\PermissionGroup;
use app\admin\model\Permission;
use think\facade\Request;

class Role extends Base
{
//    protected $middleware = ['Permission'];

    public function index()
    {
        $this->getUserName();
        //查询所有角色
        $roleList = RoleModel::select();

        $this->view->assign('num', 1);
        $this->view->assign('roleList', $roleList);
        return $this->view->fetch('index');
    }

    /**
     * 渲染创建页面
     * @return string
     * @throws \Exception
     */
    public function create()
    {
        $this->getUserName();
        return $this->view->fetch('create');
    }

    /**
     * 保存新建角色
     */
    public function save()
    {
        $data = Request::param();
        $rule = ['name|角色名称'=>'require|chsAlpha'];
        $res = $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

        return RoleModel::create($data)
            ? $this->success('添加角色成功', 'admin/role/index')
            : $this->error('添加角色失败');
    }

    /**
     * 删除角色
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return RoleModel::destroy($id)
            ? ['status'=>1,'message'=>'删除成功']
            : ['status'=>0,'message'=>'删除失败'];
    }

    /**
     * 查询当前编辑用户名称
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function selectRole($id)
    {
        $role = RoleModel::where('id',$id)->find();
        return ['name'=>$role['name']];
    }

    public function doEdit()
    {
        $data = Request::param();

        $rule = ['name|角色名称'=>'require|chsAlpha'];
        $res = $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

        return RoleModel::where('id', $data['id'])->update($data)
            ? $this->success('保存数据成功', 'admin/role/index')
            : $this->error('保存数据失败');

    }

    public function allocation()
    {
        $id = Request::param();
        //查询所有的权限
        $this->getRightsGroups();

        //查询出角色所拥有的权限
        $rolePermission = RolePermission::whereIn('role_id', $id)->select();
//        halt($rolePermission);

        $this->view->assign('rolePermission', $rolePermission);
        $this->view->assign('roleId', $id);
        return $this->view->fetch('allocation');
    }

    public function allocationSave()
    {
        $data = Request::param();

        $rolePermission['role_id'] = $data['role_id'];
        unset($data['role_id']);

        if (!isset($data['permission'])) {
            return $this->error('还没有选择任何权限...');
        }

        RolePermission::whereIn('role_id', $rolePermission['role_id'])->delete();

        foreach ($data as $item) {
            foreach ($item as $value) {
                $rolePermission['permission_id'] = $value;
                RolePermission::create($rolePermission);
                unset($rolePermission['permission_id']);
            }
        }

        return $this->success('添加权限成功', 'admin/role/index');
    }

}