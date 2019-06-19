<?php

namespace app\admin\model;

use think\Model;


class AdminUserLoginLog extends Model
{
    protected $table = 'admin_user_login_log';
    protected $autoWriteTimestamp = true;
}