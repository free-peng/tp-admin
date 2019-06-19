<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\AdminUserLoginLog as ModelAdminLog;

class AdminUserLoginLog extends Base
{
    public function index()
    {
        $logs = ModelAdminLog::select();

        $this->view->assign('num', 1);
        $this->view->assign('logs', $logs);
        return $this->view->fetch('index');
    }

    public function delete($id)
    {
        return ModelAdminLog::destroy($id)
            ? $this->success('删除成功', 'admin/AdminUserLoginLog/index')
            : $this->error('删除失败');
    }
}