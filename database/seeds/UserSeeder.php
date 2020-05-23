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
            'ids' => '{"mobile":{"number":"13482628335", "active":true}}',
            'info' => '{"name":"姚远", "nick":"Golden"}',
            'auth' => ['org_ids' => [4,9], 'role_ids' => [4,6]],
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"13761058983", "active":true}}',
            'info' => '{"name":"鲁娴婷", "nick":"Fanny"}',
            'auth' => ['org_ids' => [8,9], 'role_ids' => [3,14]],
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"18701782407", "active":true},"email":{"addr":"july@mooibay.com", "active":true}}',
            'info' => '{"name":"吕洁", "nick":"July"}',
            'auth' => ['org_ids' => [6,9], 'role_ids' => [4,7]],
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"15911599729", "active":true}}',
            'info' => '{"name":"蒋海明", "nick":"Joe"}',
            'auth' => ['org_ids' => [9], 'role_ids' => [4]],
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"13901752021", "active":true}}',
            'info' => '{"name":"倪昌盛", "nick":"Kris"}',
            'auth' => ['org_ids' => [5,9], 'role_ids' => [1,4,15]],
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"19951510566", "active":true}}',
            'info' => '{"name":"戴玉", "nick":"Frola"}',
            'auth' => ['org_ids' => [6], 'role_ids' => [5,11]],
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"13951195320", "active":true}}',
            'info' => '{"name":"仲一玲", "nick":"Bella"}',
            'auth' => ['org_ids' => [6], 'role_ids' => [12]],
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"17601501535，", "active":true}, "email":{"addr":"duppy3@vip.qq.com", "active":true}}',
            'info' => '{"name":"钱程", "nick":"Kotoba"}',
            'locked' => true,
            'auth' => ['org_ids' => [6]],
        ]);
    }
}

