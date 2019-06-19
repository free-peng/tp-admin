<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateRolesTable extends Migrator
{
    public function change()
    {
        $table = $this->table('roles', ['engine' => 'InnoDB']);

        $table->addColumn("name", "string", ['limit' => 30, 'default' => '', 'comment' => '角色名称'])
            ->addColumn("create_user_name", "string", ['limit' => '50', 'default' => '', 'comment' => '创建人'])
            ->addColumn("update_user_name", "string", ['limit' => '50', 'default' => '', 'comment' => '修改人'])
            ->addColumn("create_time", "integer", ['limit' => '10', 'default' => '0', 'comment' => '创建时间'])
            ->addColumn("update_time", "integer", ['limit' => '10', 'default' => '0', 'comment' => '修改时间'])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }

    public function down(){
        $this->dropTable('roles');
    }
}
