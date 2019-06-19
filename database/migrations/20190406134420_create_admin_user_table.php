<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAdminUserTable extends Migrator
{
    public function change()
    {
        $table = $this->table('admin_users', ['engine' => 'InnoDB']);

        $table->addColumn("name", "string", ['limit' => 30, 'default' => '', 'comment' => '用户名称'])
            ->addColumn("email", "string", ['limit' => 50, 'default' => '', 'comment' => '邮箱'])
            ->addColumn("phone", "biginteger", ['limit' => '11', 'comment' => '电话号码'])
            ->addColumn("password", "string", ['limit' => '60', 'default' => '', 'comment' => '密码'])
            ->addColumn("disable", "integer", ['limit' => '1', 'default' => '1', 'comment' => '启用或者禁用，0禁用'])
            ->addColumn("create_time", "integer", ['limit' => '10', 'default' => '0', 'comment' => '创建时间'])
            ->addColumn("update_time", "integer", ['limit' => '10', 'default' => '0', 'comment' => '修改时间'])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }

    public function down(){
        $this->dropTable('admin_users');
    }
}
