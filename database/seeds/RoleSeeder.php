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
            'key' => 'root',
            'info' => '{"name":"root"}',
            'show' => false,

            'children' => [
                [
                    'key' => 'admin',
                    'info' => '{"name":"管理者"}',

                    'children' => [
                        [
                            'key' => 'chairman',
                            'info' => '{"name":"董事长"}',

                            'children' => [
                                [
                                    'key' => 'director',
                                    'info' => '{"name":"董事"}',
                                ]
                            ],
                        ],

                        [
                            'key' => 'assistant',
                            'info' => '{"name":"管理员"}',

                            'children' => [
                                [
                                    'key' => 'ceo',
                                    'info' => '{"name":"CEO", "full_name":"总经理"}',

                                    'children' => [
                                        [
                                            'key' => 'coo',
                                            'info' => '{"name":"COO", "full_name":"运营总监"}',

                                            'children' => [
                                                [
                                                    'key' => 'expo_mananer',
                                                    'info' => '{"name":"展务经理"}',

                                                    'children' => [
                                                        [
                                                            'key' => 'ticket_director',
                                                            'info' => '{"name":"票务主管"}',

                                                            'children' => [
                                                                [
                                                                    'key' => 'ticket_clerk',
                                                                    'info' => '{"name":"票务专员"}',
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],

                                                [
                                                    'key' => 'online_mananer',
                                                    'info' => '{"name":"运营经理"}',
                                                ],

                                                [
                                                    'key' => 'legal_mananer',
                                                    'info' => '{"name":"法务经理"}',
                                                ],

                                            ],
                                        ],

                                        [
                                            'key' => 'cmo',
                                            'info' => '{"name":"CMO", "full_name":"市场总监"}',
                                        ],

                                        [
                                            'key' => 'cfo',
                                            'info' => '{"name":"CFO", "full_name":"财务总监"}',
                                        ],

                                        [
                                            'key' => 'cto',
                                            'info' => '{"name":"CTO", "full_name":"技术总监"}',
                                        ],

                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

    }
}
