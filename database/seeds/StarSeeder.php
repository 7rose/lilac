<?php

use App\Star;
use Illuminate\Database\Seeder;

class StarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Star::create([
            'video_id' => 1,
            'created_by' => 7,
        ]);

        Star::create([
            'video_id' => 1,
            'created_by' => 8,
        ]);
        
        Star::create([
            'video_id' => 2,
            'created_by' => 7,
        ]);
    }
}
