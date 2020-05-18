<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'parent_id' => 0,
            'key' => 'sys',
            'info' => '{"name":"系统"}',
            'show' => false,
        ]);

        Role::create([
            'parent_id' => 1,
            'key' => 'root',
            'info' => '{"name":"高级管理"}',
        ]);

        Role::create([
            'parent_id' => 2,
            'key' => 'admin',
            'info' => '{"name":"管理"}',
        ]);

        Role::create([
            'parent_id' => 3,
            'key' => 'ceo',
            'info' => '{"name":"CEO"}',
        ]);
        # 4

        Role::create([
            'parent_id' => 4,
            'key' => 'coo',
            'info' => '{"name":"COO"}',
        ]);

        Role::create([
            'parent_id' => 5,
            'key' => 'checker',
            'info' => '{"name":"票务"}',
        ]);
        # 6

        Role::create([
            'parent_id' => 4,
            'key' => 'cfo',
            'info' => '{"name":"CFO"}',
        ]);

        Role::create([
            'parent_id' => 7,
            'key' => 'finance',
            'info' => '{"name":"财务"}',
        ]);
        # 8

        Role::create([
            'parent_id' => 2,
            'key' => 'partner',
            'info' => '{"name":"股东"}',
        ]);
        # 9

        Role::create([
            'parent_id' => 4,
            'key' => 'cto',
            'info' => '{"name":"CTO"}',
        ]);
    }
}
