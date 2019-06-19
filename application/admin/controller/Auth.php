<?php

namespace app\admin\controller;
use app\admin\common\controller\Base;
use think\facade\Request;
use think\facade\Session;
use think\Controller;
use app\admin\model\AdminUser;
use app\admin\model\AdminUserLoginLog;


class Auth extends Controller
{
    //登录也
    public function login()
    {
        return $this->view->fetch('index');
    }
    /**
     * 验证登录
     */
    public function check()
    {
        $data = Request::param();
//        halt($data);
        $rule = [
            'name|用户名' => 'require',
            'password|密码' => 'require',
        ];
        $validateResult = $this->validate($data, $rule);
        if (! $validateResult) {
            return $this->error($validateResult);
        }

        $adminUser = AdminUser::where("name", $data['name'])->find();
        if ($adminUser->password != sha1($data['password']) || !$adminUser) {
            return $this->error('账号或密码有误');
        }

        //判断账号是否禁用
        if ($adminUser->disable == 0) {
            return $this->error('当前账号处于禁用状态，请联系管理员处理','admin/Auth/login');
        }

        Session::set('user_id',$adminUser->id);
        Session::set('name',$adminUser->name);
//        halt($_SESSION);

        $logs['user_name'] = $adminUser->name;
        $logs['ip'] = $_SERVER['REMOTE_ADDR'];

        return AdminUserLoginLog::create($logs)
            ? $this->success('登录成功','admin/index/index')
            : $this->error('登录失败');
    }

    //退出登录
    public function logout()
    {
        Session::clear();
        $this->success('退出成功','admin/Auth/login');
    }
}