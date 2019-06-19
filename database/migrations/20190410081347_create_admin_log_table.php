<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAdminLogTable extends Migrator
{
    public function change()
    {
        $table = $this->table("admin_user_login_log", ['engine' => 'InnoDB']);

        $table->addColumn("user_name", "string", ['limit'=>30, 'default'=>'', 'comment'=>'登录账号'])
            ->addColumn("ip", "string", ['limit'=>30, 'default'=>'', 'comment'=>'登录IP'])
            ->addColumn("create_time", "integer", ['limit' => '10', 'default' => 0, 'comment' => '创建时间'])
            ->create();
    }

    public function down()
    {
        $this->dropTable("admin_user_login_log");
    }
}
