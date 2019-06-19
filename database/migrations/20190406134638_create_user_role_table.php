<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateUserRoleTable extends Migrator
{
    public function change()
    {
        $table = $this->table('user_role', ['engine' => 'InnoDB']);

        $table->addColumn("user_id", "integer", ['limit' => 11,  'comment' => '用户ID'])
            ->addColumn("role_id", "integer", ['limit' => 11 , 'comment' => '角色ID'])
            ->create();
    }

    public function down(){
        $this->dropTable('user_role');
    }
}
