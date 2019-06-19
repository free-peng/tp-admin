<?php

use think\migration\Seeder;

class MenusSeeder extends Seeder
{


    public function run()
    {
        $data = [
            [
                'name' => '访问权限',
                'icon' => '',
                'url' => '',
                'parent_id' => 0,
                'create_time' => 1555316593,
                'update_time' => 1555316593,
                'sequence' => 1,
                'permission_name' => 0,
                'user_name' => 'admin'
            ],

            [
                'name' => '用户管理',
                'icon' => '',
                'url' => 'admin/user/index',
                'parent_id' => 4,
                'create_time' => 1555316593,
                'update_time' => 1555316593,
                'sequence' => 1,
                'permission_name' => 'admin/User/index',
                'user_name' => 'admin'
            ],


            [
                'name' => '角色管理',
                'icon' => '',
                'url' => 'admin/role/index',
                'parent_id' => 4,
                'create_time' => 1555316593,
                'update_time' => 1555316593,
                'sequence' => 1,
                'permission_name' => 'admin/role/index',
                'user_name' => 'admin'
            ],
            [
                'name' => '权限管理',
                'icon' => '',
                'url' => 'admin/permission/index',
                'parent_id' => 4,
                'create_time' => 1555316593,
                'update_time' => 1555316593,
                'sequence' => 1,
                'permission_name' => 'admin/permission/index',
                'user_name' => 'admin'
            ],
            [
                'name' => '菜单管理',
                'icon' => '',
                'url' => 'admin/RightsGroups/index',
                'parent_id' => 4,
                'create_time' => 1555316593,
                'update_time' => 1555316593,
                'sequence' => 1,
                'permission_name' => 'admin/rights_groups/index',
                'user_name' => 'admin'
            ],
            [
                'name' => '权限组',
                'icon' => '',
                'url' => 'admin/menu/index',
                'parent_id' => 4,
                'create_time' => 1555316593,
                'update_time' => 1555316593,
                'sequence' => 1,
                'permission_name' => 'admin/menu/index',
                'user_name' => 'admin'
            ],
        ];
        $this->table('menus')->insert($data)->save();
    }
}