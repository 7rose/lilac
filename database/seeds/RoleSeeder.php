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
        // 管理机构
        Role::create([
            'key' => 'sys',
            'info' => ['name' => '系统'],

            'children' => [
                [
                    'key' => 'root',
                    'info' => ['name' => '管理者'],

                    'children' => [
                        [
                            'key' => 'admin',
                            'info' => ['name' => '管理员'],
                        ],
                    ],
                ],
            ],
        ]);

        // 总经理办公室
        Role::create([
            'key' => 'president',
            'info' => ['name' => 'CEO', 'full_name' => '总经理'],

            'children' => [
                [
                    'key' => 'vice_president',
                    'info' => ['name' => '副总经理'],

                    'children' => [
                        [
                            'key' => 'assistant',
                            'info' => ['name' => '助理'],
                        ],
                    ],
                ],
            ],
        ]);

        // 技术部
        Role::create([
            'key' => 'cto',
            'info' => ['name' => 'CTO', 'full_name' => '技术总监'],

            'children' => [
                [
                    'key' => 'tech_manager',
                    'info' => ['name' => '经理'],
                ],
            ],
        ]);

        // 运营部
        Role::create([
            'key' => 'coo',
            'info' => ['name' => 'COO', 'full_name' => '运营总监'],

            'children' => [
                [
                    'key' => 'expo_manager',
                    'info' => ['name' => '展务经理'],

                    'children' => [
                        [
                            'key' => 'ticket_leader',
                            'info' => ['name' => '票务主管'],
                        ]
                    ],
                ],

                [
                    'key' => 'biz_manager',
                    'info' => ['name' => '商务经理'],
                ],

                [
                    'key' => 'online_manager',
                    'info' => ['name' => '运营经理'],
                ],

                [
                    'key' => 'ad_manager',
                    'info' => ['name' => '行政经理'],
                ],

                [
                    'key' => 'legal_manager',
                    'info' => ['name' => '法务经理'],
                ],
            ],
        ]);

        // 市场部
        Role::create([
            'key' => 'cmo',
            'info' => ['name' => 'CMO', 'full_name' => '市场总监'],

            'children' => [
                [
                    'key' => 'buy_manager',
                    'info' => ['name' => '采购经理'],
                ],

                [
                    'key' => 'sale_manager',
                    'info' => ['name' => '销售经理'],
                ],
            ],
        ]);

        // 财务部
        Role::create([
            'key' => 'cfo',
            'info' => ['name' => 'CFO', 'full_name' => '财务总监'],

            'children' => [
                [
                    'key' => 'finance_manager',
                    'info' => ['name' => '财务经理'],
                ],

                [
                    'key' => 'audit_manager',
                    'info' => ['name' => '审计经理'],
                ],
            ],
        ]);

        // 产品部
        Role::create([
            'key' => 'cpo',
            'info' => ['name' => 'CPO', 'full_name' => '产品总监'],

            'children' => [
                [
                    'key' => 'product_manager',
                    'info' => ['name' => '财务经理'],
                ],

                [
                    'key' => 'quality_manager',
                    'info' => ['name' => '质量经理'],
                ],
            ],
        ]);

        // 董事会
        Role::create([
            'key' => 'chairman',
            'info' => ['name' => '董事长'],

            'children' => [
                [
                    'key' => 'director',
                    'info' => ['name' => '董事'],
                ],
            ],
        ]);

    }
}
