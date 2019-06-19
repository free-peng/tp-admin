<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateMenuTable extends Migrator
{
    public function change()
    {
        $table = $this->table('menus', ['engine' => 'InnoDB']);

        $table->addColumn("name", "string", ['limit' => 50, 'default' => '', 'comment' => '菜单名称'])
            ->addColumn("icon", "string", ['default' => '', 'comment'=>'菜单图标'])
            ->addColumn("url", "string", ['default' => '', 'comment'=>'菜单url'])
            ->addColumn("parent_id", 'integer', ['default' => 0, 'comment'=>'上级菜单'])
            ->addColumn("permission_name", 'string', ['default' => '', 'comment'=>'权限名称'])
            ->addColumn("user_name", 'string', ['limit' => '50','default' => '', 'comment'=>'创建人名称'])
            ->addColumn("create_time", "integer", ['limit' => '10', 'default' => 0, 'comment' => '创建时间'])
            ->addColumn("update_time", "integer", ['limit' => '10', 'default' => 0, 'comment' => '修改时间'])
            ->addColumn("sequence", "integer", ['default' => 0])
            ->create();
    }

    public function down()
    {
        $this->dropTable("menus");
    }
}
