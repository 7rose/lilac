<?php

use App\Org;
use Illuminate\Database\Seeder;

class OrgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Org::create([
            'key' => 'sys',
            'info' => ['name' => 'Lilac'],
            'show' => false,
            'type' => 'org',
            'conf' => ['roles_id' => 1],

            'children' => [
                [
                    'key' => 'main',
                    'info' => ['name' => '牧云', 'full_name' => '上海牧云玩具设计有限公司'],
                    'type' => 'org',

                    'children' => [
                        [
                            'key' => 'staff',
                            'info' => ['name' => 'mooibay.com'],
                            'type' => 'sort',

                            'children' => [
                                [
                                    'key' => 'president',
                                    'info' => ['name' => '总经理办公室', 'show' => false],
                                    'type' => 'branch',
                                    'conf' => ['roles_id' => 4],

                                    'children' => [
                                        [
                                            'key' => 'technology',
                                            'info' => ['name' => '技术部'],
                                            'type' => 'branch',
                                            'conf' => ['roles_id' => 7],
                                        ],

                                        [
                                            'key' => 'operation',
                                            'info' => ['name' => '运营部'],
                                            'type' => 'branch',
                                            'conf' => ['roles_id' => 9],
                                        ],

                                        [
                                            'key' => 'market',
                                            'info' => ['name' => '市场部'],
                                            'type' => 'branch',
                                            'conf' => ['roles_id' => 16],
                                        ],

                                        [
                                            'key' => 'finance',
                                            'info' => ['name' => '财务部'],
                                            'type' => 'branch',
                                            'conf' => ['roles_id' => 19],
                                        ],

                                        [
                                            'key' => 'product',
                                            'info' => ['name' => '产品部'],
                                            'type' => 'branch',
                                            'conf' => ['roles_id' => 22],
                                        ],

                                    ],
                                ],

                                [
                                    'key' => 'board',
                                    'info' => ['name' => '董事会'],
                                    'type' => 'branch',
                                    'conf' => ['roles_id' => 25],
                                ],
                            ],
                        ],

                        [
                            'key' => 'supplier',
                            'info' => ['name' => '供应商'],
                            'type' => 'sort',
                        ],

                        [
                            'key' => 'customer',
                            'info' => ['name' => '客户'],
                            'type' => 'sort',
                        ],

                        [
                            'key' => 'partner',
                            'info' => ['name' => '合作伙伴'],
                            'type' => 'sort',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
