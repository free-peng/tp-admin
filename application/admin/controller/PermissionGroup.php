<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use think\facade\Request;
use app\admin\model\PermissionGroup as ModelPermissionGroups;
use app\admin\model\Permission;


class PermissionGroup extends Base
{
    public function index()
    {
        $this->getRightsGroups();
        return $this->view->fetch('index');
    }

    /**
     * 添加权限组页面
     * @return string
     * @throws \Exception
     */
    public function create()
    {
        return $this->view->fetch('create');
    }

    /**
     * 保存权限组添加
     */
    public function save()
    {
        $data = Request::param();

        $rule = ['name|权限组名称' => 'require|length:2,20'];
        $res = $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

        return ModelPermissionGroups::create($data)
            ? $this->success('添加成功,添加权限请求权限管理添加', 'admin/RightsGroups/index')
            : $this->error('添加失败');

    }

    /**
     * 删除权限
     * @throws \Exception
     */
    public function delete()
    {
        $data = Request::param();
        $ids = [];
        foreach($data as $ietm) {
            foreach ($ietm as $value) {
                $ids[] = $value;
            }
        }

        return Permission::whereIn('id',$ids)->delete()
            ? $this->success('删除成功')
            : $this->error('删除失败');
    }

    /**
     * 删除权限组
     * @param $id
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function deleteGroup($id)
    {
        return Permission::where('group_id' ,$id)->delete() && ModelPermissionGroups::destroy($id)
            ? ['message'=>'删除成功']
            : ['message'=>'删除失败'];
    }

    /**
     * 权限组编辑页面
     * @param $id
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit($id)
    {
        $data = ModelPermissionGroups::where('id',$id)->find();

        $this->view->assign('group', $data);
        return $this->view->fetch('edit');
    }

    public function doEdit()
    {

        $data = Request::param();

        $rule = ['name|权限组名称' => 'require|length:2,20'];
        $res = $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

        return ModelPermissionGroups::where('id', $data['id'])->update($data)
            ? $this->success('编辑成功','admin/RightsGroups/index')
            : $this->error('编辑失败');

    }

}