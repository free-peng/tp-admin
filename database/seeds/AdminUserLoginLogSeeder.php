<?php

use think\migration\Seeder;

class AdminUserLoginLogSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_name' => 'admin',
                'ip' => '127.0.0.1',
                'create_time' => 1554886482,
            ],
            [
                'user_name' => 'admin',
                'ip' => '127.0.0.1',
                'create_time' => 1554886482,
            ],
            [
                'user_name' => 'admin',
                'ip' => '127.0.0.1',
                'create_time' => 1555413735,
            ],
            [
                'user_name' => 'admin',
                'ip' => '127.0.0.1',
                'create_time' => 1555414324,
            ],
        ];
        $this->table('admin_user_login_log')->insert($data)->save();
    }
}