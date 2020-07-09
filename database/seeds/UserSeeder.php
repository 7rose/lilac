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
            'ids'  => ['mobile' => ['number' => '13761058983', 'active' => true]],
            'info' => ['name' => '鲁娴婷', 'nick' => 'fanny'],
            'conf' => ['roles' => [['org_id' => 8, 'role_id' => 19], ['org_id' => 10, 'role_id' => 25, 'default' => true]]],
        ]);

        User::create([
            'ids'  => ['mobile' => ['number' => '18701782407', 'active' => true], 'email' => ['addr' => 'july@mooibay.com', 'active' => true]],
            'info' => ['name' => '吕洁', 'nick' => 'july'],
            'conf' => ['roles' => [['org_id' => 4, 'role_id' => 4, 'default' => true], ['org_id' => 10, 'role_id' => 26]]],
        ]);

        User::create([
            'ids'  => ['mobile' => ['number' => '13482628335', 'active' => true]],
            'info' => ['name' => '姚远', 'nick' => 'golden'],
            'conf' => ['roles' => [['org_id' => 6, 'role_id' => 9, 'default' => true], ['org_id' => 10, 'role_id' => 26]]],
        ]);

        User::create([
            'ids'  => ['mobile' => ['number' => '15911599729', 'active' => true]],
            'info' => ['name' => '蒋海明', 'nick' => 'joe'],
            'conf' => ['roles' => [['org_id' => 10, 'role_id' => 26]]],
        ]);

        User::create([
            'ids'  => ['mobile' => ['number' => '13901752021', 'active' => true]],
            'info' => ['name' => '倪昌盛', 'nick' => 'kris'],
            'conf' => ['roles' => [['org_id' => 1, 'role_id' => 1], ['org_id' => 5, 'role_id' => 7, 'default' => true], ['org_id' => 10, 'role_id' => 26]]],
        ]);

        User::create([
            'ids'  => ['mobile' => ['number' => '19951510566', 'active' => true]],
            'info' => ['name' => '戴玉', 'nick' => 'frola'],
            'conf' => ['roles' => [['org_id' => 1, 'role_id' => 2], ['org_id' => 6, 'role_id' => 13, 'default' => true]]],
        ]);

        User::create([
            'ids'  => ['mobile' => ['number' => '13951195320', 'active' => true]],
            'info' => ['name' => '仲一玲', 'nick' => 'bella'],
            'conf' => ['roles' => [['org_id' => 6, 'role_id' => 15]]],
        ]);

        User::create([
            'ids'    => ['mobile' => ['number' => '15021170027', 'active' => true]],
            'info'   => ['name' => '小安', 'nick' => 'Amy'],
            'conf'   => ['roles' => [['org_id' => 6, 'role_id' => null]]],
        ]);
    }
}
