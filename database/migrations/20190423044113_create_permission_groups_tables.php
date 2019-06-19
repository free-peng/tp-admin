<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreatePermissionGroupsTables extends Migrator
{
    public function change()
    {
        $table = $this->table("permission_groups", ['engine' => 'InnoDB']);

        $table->addColumn("name", "string", ['limit'=>30, 'default'=>'', 'comment'=>'权限组名称'])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }

    public function down()
    {
        $this->dropTable("permission_groups");
    }
}
