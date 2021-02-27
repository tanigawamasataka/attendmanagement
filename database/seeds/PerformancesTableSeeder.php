<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerformanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('performances')->insert([
            ['id' => '1',
            'timecard_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '2',
            'timecard_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
        ]);
    }
}