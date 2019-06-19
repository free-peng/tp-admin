<?php

use think\migration\Seeder;

class AdminUsersSeeder extends Seeder
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
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'phone' => 18888888888,
                'password' => '7c4a8d09ca3762af61e59520943dc26494f8941b',
                'disable' => 1,
                'create_time' => 1554053252,
                'update_time' => 1554053252
            ],

            [
                'name' => '彭波',
                'email' => 'xiaobo@xiaobo.com',
                'phone' => 18808308635,
                'password' => '7c4a8d09ca3762af61e59520943dc26494f8941b',
                'disable' => 0,
                'create_time' => 1554053252,
                'update_time' => 1554053252
            ]
        ];
        $this->table('admin_users')->insert($data)->save();
    }
}