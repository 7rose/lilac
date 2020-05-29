<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'ids' => ['mobile' => ['number' => '13482628335', 'active' => true]],
            'info' => ['name' => '姚远', 'nick' => 'Golden'],
            'conf' => ['roles' => [['org' => 4, 'role' => 4, 'default' => true],['org' => 10, 'role' => 26]]],
        ]);

        User::create([
            'ids' => ['mobile' => ['number' => '13761058983', 'active' => true]],
            'info' => ['name' => '鲁娴婷', 'nick' => 'Fanny'],
            'conf' => ['roles' => [['org' => 8, 'role' => 19],['org' => 10, 'role' => 25, 'default' => true]]],
        ]);

        User::create([
            'ids' => ['mobile' => ['number' => '18701782407', 'active' => true], 'email' => ['addr' => 'july@mooibay.com', 'active' => true]],
            'info' => ['name' => '吕洁', 'nick' => 'July'],
            'conf' => ['roles' => [['org' => 6, 'role' => 9, 'default' => true],['org' => 10, 'role' => 26]]],
        ]);

        User::create([
            'ids' => ['mobile' => ['number' => '15911599729', 'active' => true]],
            'info' => ['name' => '蒋海明', 'nick' => 'Joe'],
            'conf' => ['roles' => [['org' => 10, 'role' => 26]]],
        ]);

        User::create([
            'ids' => ['mobile' => ['number' => '13901752021', 'active' => true]],
            'info' => ['name' => '倪昌盛', 'nick' => 'Kris'],
            'conf' => ['roles' => [['org' => 1, 'role' => 1],['org' => 5, 'role' => 7, 'default' => true],['org' => 10, 'role' => 26]]],
        ]);

        User::create([
            'ids' => ['mobile' => ['number' => '19951510566', 'active' => true]],
            'info' => ['name' => '戴玉', 'nick' => 'Frola'],
            'conf' => ['roles' => [['org' => 1, 'role' => 2],['org' => 6, 'role' => 13, 'default' => true]]],
        ]);

        User::create([
            'ids' => ['mobile' => ['number' => '13951195320', 'active' => true]],
            'info' => ['name' => '仲一玲', 'nick' => 'Bella'],
            'conf' => ['roles' => [['org' => 6, 'role' => 15]]],
        ]);

        User::create([
            'ids' => ['mobile' => ['number' => '17601501535', 'active' => true]],
            'info' => ['name' => '钱程', 'nick' => 'Kotoba'],
            'locked' => true,
            // 'conf' => ['roles' => [['org' => 6, 'role'=>null]]],
        ]);

    }
}

