<?php

use think\migration\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'name' => '用户编辑',
                'create_time' => 1554053252,
                'update_time' => 1554053252,
                'create_user_name' => 'admin',
                'update_user_name' => 'admin'
            ],
            [
                'name' => '测试',
                'create_time' => 1554053252,
                'update_time' => 1554053252,
                'create_user_name' => 'admin',
                'update_user_name' => 'admin'
            ],
            [
                'name' => '管理员',
                'create_time' => 1554053252,
                'update_time' => 1554053252,
                'create_user_name' => 'admin',
                'update_user_name' => 'admin'
            ]
        ];

        $this->table('roles')->insert($data)->save();
    }
}