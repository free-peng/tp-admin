<?php

use think\migration\Seeder;

class PermissionGroupsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => '菜单管理'
            ],
            [
                'name' => '用户管理'
            ],
            [
                'name' => '角色管理'
            ],
            [
                'name' => '权限管理'
            ],
            [
                'name' => '权限组'
            ],
        ];
        $this->table('permission_groups')->insert($data)->save();
    }
}