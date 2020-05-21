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
            'ids' => '{"mobile":{"number":"13482628335", "active":true}, "wechat":{"id":null, "info":null}}',
            'info' => '{"name":"姚远", "nick":"Golden"}',
            'auth' => '{"org_ids":[2],"role_ids":[4,9]}',
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"13761058983", "active":true}, "wechat":{"id":null, "info":null}}',
            'info' => '{"name":"鲁娴婷", "nick":"Fanny"}',
            'auth' => '{"org_ids":[2],"role_ids":[7,9]}',
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"18701782407", "active":true},"email":{"addr":"july@mooibay.com", "active":true}, "wechat":{"id":null, "info":null}}',
            'info' => '{"name":"吕洁", "nick":"July"}',
            'auth' => '{"org_ids":[2],"role_ids":[5,9]}',
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"13901752021", "active":true}, "wechat":{"id":null, "info":null}}',
            'info' => '{"name":"倪昌盛", "nick":"Kris"}',
            'auth' => '{"org_ids":[1,2],"role_ids":[1,9]}',
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"15911599729", "active":true}, "wechat":{"id":null, "info":null}}',
            'info' => '{"name":"蒋海明", "nick":"Joe"}',
            'auth' => '{"org_ids":[2],"role_ids":[9]}',
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"19951510566", "active":true}, "wechat":{"id":null, "info":null}}',
            'info' => '{"name":"戴玉", "nick":"Frola"}',
            'auth' => '{"org_ids":[2],"role_ids":[3]}',
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"13951195320", "active":true}, "wechat":{"id":null, "info":null}}',
            'info' => '{"name":"仲一玲", "nick":"Bella"}',
            'auth' => '{"org_ids":[2]}',
        ]);

        User::create([
            'ids' => '{"mobile":{"number":"17601501535，", "active":true}, "email":{"addr":"duppy3@vip.qq.com", "active":true}, "wechat":{"id":null, "info":null}}',
            'info' => '{"name":"钱程", "nick":"Kotoba"}',
            'auth' => '{"org_ids":[2]}',
        ]);
    }
}

