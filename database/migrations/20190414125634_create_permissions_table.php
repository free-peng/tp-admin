<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreatePermissionsTable extends Migrator
{
    public function change()
    {
        $table = $this->table('permissions', ['engine' => 'InnoDB']);

        $table->addColumn('name', 'string', ['limit'=>50, 'comment'=>'权限控制名称'])
            ->addColumn('show_name', 'string', ['limit'=>50, 'comment'=>'页面控制名称'])
            ->addColumn('group_id', 'integer', ['limit'=>11, 'default'=>0, 'comment'=>'权限组id'])
            ->addColumn("create_time", "integer", ['limit' => '10', 'default' => '0', 'comment' => '创建时间'])
            ->addColumn("update_time", "integer", ['limit' => '10', 'default' => '0', 'comment' => '修改时间'])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }

    public function down(){
        $this->dropTable('permissions');
    }
}
