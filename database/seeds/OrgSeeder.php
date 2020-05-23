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
            'key' => 'root',
            'info' => '{"name":"root"}',
            'show' => false,

            'children' => [
                [
                    'key' => 'main',
                    'info' => '{"name":"牧云", "full_name":"上海牧云玩具设计有限公司", "email":"hi@mooibay.com"}',

                    'children' => [
                        [
                            'key' => 'staff',
                            'info' => '{"name":"mooibay.com"}',

                            'children' => [
                                [
                                    'key' => 'ceo',
                                    'info' => '{"name":"总经理"}',

                                    'children' => [
                                        [
                                            'key' => 'technology',
                                            'info' => '{"name":"技术部"}',
                                        ],

                                        [
                                            'key' => 'operation',
                                            'info' => '{"name":"运营部"}',
                                        ],

                                        [
                                            'key' => 'market',
                                            'info' => '{"name":"市场部"}',
                                        ],

                                        [
                                            'key' => 'finance',
                                            'info' => '{"name":"财务部"}',
                                        ],

                                    ],
                                ],

                                [
                                    'key' => 'board',
                                    'info' => '{"name":"董事会"}',
                                ],
                            ],
                        ],

                        [
                            'key' => 'supplier',
                            'info' => '{"name":"供应商"}',
                        ],

                        [
                            'key' => 'customer',
                            'info' => '{"name":"客户"}',
                        ],

                        [
                            'key' => 'partner',
                            'info' => '{"name":"合作伙伴"}',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
