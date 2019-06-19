<?php

namespace app\admin\model;

use think\Model;

class AdminUser extends Model
{
    protected $table = 'admin_users';
    protected $autoWriteTimestamp = true;
}