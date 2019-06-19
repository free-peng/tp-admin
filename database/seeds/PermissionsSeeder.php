<?php

use think\migration\Seeder;

class PermissionsSeeder extends Seeder
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
                //32
                'name' => 'admin/User/index',
                'group_id' => 2,
                'show_name' => '用户管理',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //33
                'name' => 'admin/user/edituserselect',
                'group_id' => 2,
                'show_name' => '用户编辑',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //34
                'name' => 'admin/user/selectcharacter',
                'group_id' => 2,
                'show_name' => '分配角色',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //35
                'name' => 'admin/user/dopass',
                'group_id' => 2,
                'show_name' => '修改密码',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //36
                'name' => 'admin/user/disable',
                'group_id' => 2,
                'show_name' => '启用或禁用账号',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //37
                'name' => 'admin/user/create',
                'group_id' => 2,
                'show_name' => '添加用户',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //38
                'name' => 'admin/role/index',
                'group_id' => 4,
                'show_name' => '角色管理',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //39
                'name' => 'admin/role/create',
                'group_id' => 4,
                'show_name' => '创建角色',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //41
                'name' => 'admin/role/allocation',
                'group_id' => 4,
                'show_name' => '查看或编辑权限',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //42
                'name' => 'admin/permission/selectpermission',
                'group_id' => 4,
                'show_name' => '编辑权限',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //43
                'name' => 'admin/permission/index',
                'group_id' => 5,
                'show_name' => '权限管理',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //44
                'name' => 'admin/permission/create',
                'group_id' => 5,
                'show_name' => '添加权限',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //45
                'name' => 'admin/permission/delete',
                'group_id' => 5,
                'show_name' => '删除权限',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //46
                'name' => 'admin/rights_groups/index',
                'group_id' => 6,
                'show_name' => '权限组',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //47
                'name' => 'rights_groups/create',
                'group_id' => 6,
                'show_name' => '创建权限组',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //48
                'name' => 'admin/rightsgroups/deletegroup',
                'group_id' => 6,
                'show_name' => '删除权限组',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //49
                'name' => 'admin/rights_groups/edit',
                'group_id' => 6,
                'show_name' => '编辑权限组',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
            [
                //50
                'name' => 'admin/menu/index',
                'group_id' => 1,
                'show_name' => '菜单管理',
                'create_time' => 1555575168,
                'update_time' => 1555575168
            ],
        ];

        $this->table('permissions')->insert($data)->save();
    }
}