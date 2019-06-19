<?php
/**
 * Created by PhpStorm.
 * AdminUser: Windows10
 * Date: 2019/3/29
 * Time: 14:00
 */

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\AdminUser;
use think\facade\Request;
use think\facade\Session;
use app\admin\model\UserRole;
use app\admin\model\Role;
use think\Model;

class User extends Base
{
//    protected $middleware = ['Permission'];

    public function index()
    {
        $userRole = UserRole::select();
        $this->view->assign('userRole', $userRole);
//        halt($userRole);

        $roles = Role::select();
        $this->view->assign('roles', $roles);

//        halt($character);
        $userData = AdminUser::select();

        $this->view->assign('userData',$userData);
        return $this->view->fetch('index');
    }

    public function create()
    {
        //查询角色
        $character = Role::select();

        $this->view->assign('character', $character);
        return $this->view->fetch('create');
    }

    public function save()
    {
        $data = Request::param();
        $permission = [];

        $rule = [
          'name|用户名' => 'require|length:2,10',
            'email|邮箱' => 'require|email',
            'phone|电话' => 'require|mobile',
            'password|密码' => 'require|length:6,16'
        ];
        $res = $this->validate($data,$rule);
        if ($res !== true) {
            return $this->error($res);
        }

        $data['password'] = sha1($data['password']);
        $user = AdminUser::create($data);
        $permission['user_id'] = $user->id;

        if (isset($data['user-edit'])) {
            foreach ($data['user-edit'] as $time) {
                $permission['character_id']  = $time;
                UserRole::create($permission);
            }
        }
        return $user
            ? $this->success('添加成功','admin/user/index')
            : $this->error('添加失败');
    }

    /**
     * 启用或者禁用账号
     * @return array
     */
    public function disable()
    {
        $id = Request::param();

        $user = AdminUser::whereIn('id', $id)->find();
        if ($user->disable == 1) {
            $disable = AdminUser::whereIn('id',$id)->update(['disable'=>0]);
            return !$disable
                ?  ['status'=>0, 'message'=>'禁用失败']
                :  ['status'=>1,'message'=>'禁用成功'];
        }

        $disable = AdminUser::whereIn('id',$id)->update(['disable'=>1]);
        return !$disable
            ?  ['status'=>0, 'message'=>'启用失败']
            :  ['status'=>1,'message'=>'启用成功'];
    }

    public function delete($id)
    {
        return AdminUser::destroy($id)
            ? ['status'=>1,'message'=>'删除成功']
            : ['status'=>1,'message'=>'删除失败'];
    }

    public function editUserSelect($id)
    {
        //查询编辑用户
        $id = Request::param('id');
        $user = AdminUser::where('id', $id)->find();
        unset($user['password']);
        unset($user['create_time']);
        unset($user['update_time']);
//        dump($user);
        return json_encode($user);
    }

    //保存用户编辑
    public function doEdit()
    {
        $data = Request::param();
        $rule = [
            'name|用户名' => 'require|length:2,10',
            'email|邮箱' => 'require|email',
            'phone|电话' => 'require|mobile',
        ];
        $res = $this->validate($data, $rule);
        if ($res !== true) {
            return $this->error($res);
        }

         return AdminUser::where('id',$data['id'])->update($data)
             ? $this->success('修改成功','admin/user/index')
             : $this->error('修改失败或者未做修改');
    }

    //查询密码
    public function password($id)
    {
        //查询出用户
        $user = AdminUser::where('id',$id)->find();

        return ['id'=>$user['id'],'name'=>$user['name']];
    }

    //保存修改的密码
    public function doPass()
    {
        $data = Request::param();

        $rule = [
            'password|密码' => 'require|length:6,16',
            'password1|确认密码' => 'require|confirm:password'
        ];
        $res = $this->validate($data,$rule);
        if ($res !== true) {
            return $this->error($res);
        }

        $data['password'] = sha1($data['password']);
        unset($data['password1']);
        return AdminUser::where('id',$data['id'])->update($data)
            ? $this->success('修改成功','admin/user/index')
            : $this->error('修改失败(新旧密码可能一致)');
    }

    //查询角色
    public function selectCharacter($id)
    {
        $data = UserRole::where('user_id', $id)->select();

        $char = [];
        foreach ($data as $value) {
            $char[] = $value['role_id'];
        }
//        halt($char);
        $user = AdminUser::where('id', $id)->find();
        $char[] = $user['name'];

//         halt(json_encode($char));
        return json_encode($char);
    }

    //保存用户编辑角色
    public function saveRole(){
        $data = Request::param();

        if (empty($data['user-edit'])) {
            return $this->error('还没有选择角色');
        }

//        $deleteRole = UserRole::whereIn('user_id',$data['id'])->delete();
//        if (!$deleteRole) {
//            return $this->error('保存数据失败....');
//        }

        $userRole = UserRole::where('user_id',$data['id'])->select();
        if ($userRole) {
            UserRole::whereIn('user_id',$data['id'])->delete();
        }

        $role = [];
        $role['user_id'] = $data['id'];
        foreach ($data['user-edit'] as $value) {
            $role['role_id'] = $value;
            UserRole::create($role);
            unset($role['role_id']);
        }

        return $this->success('保存数据成功', 'admin/user/index');
    }

}