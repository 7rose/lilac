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
            'parent_id' => 0,
            'info' => '{
                "name":"Lilac"
            }',
            'show' => false,
        ]);

        Org::create([
            'parent_id' => 1,
            'info' => '{
                "name":"牧云",
                "full_name":"上海牧云玩具设计有限公司",
                "email":"hi@mooibay.com",
                "beian":"沪ICP备20011997号-1",
                "config": {
                    "seed": true
                }
            }',
        ]);

        Org::create([
            'parent_id' => 2,
            'info' => '{
                "name":"合作方",
                "full_name":"合作方",
                "config": {
                    "show_org_info": false,
                    "see_in_staff": false
                }
            }',
        ]);

        Org::create([
            'parent_id' => 2,
            'info' => '{
                "name":"未分组",
                "full_name":"未分组的用户",
                "config": {
                    "show_org_info": false,
                    "see_in_staff": false
                }
            }',
        ]);

    }
}
