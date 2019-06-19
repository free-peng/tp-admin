<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateRolePermissionTable extends Migrator
{
    public function change()
    {
        $table = $this->table('role_permission', ['engine' => 'InnoDB']);

        $table->addColumn("role_id", "integer", ['limit' => 11,  'comment' => '角色ID'])
            ->addColumn("permission_id", "integer", ['limit' => 11 , 'comment' => '权限ID'])
            ->create();
    }
    public function down(){
        $this->dropTable('role_permission');
    }
}
