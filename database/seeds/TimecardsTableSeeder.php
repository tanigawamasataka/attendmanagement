<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimecardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timecards')->insert([
            ['id' => '1',
            'user_id' => '3',
            'attend_date' => Carbon::now(),
            'punch_in' => '9:30:00',
            'punch_out' => '16:00:00',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '2',
            'user_id' => '2',
            'attend_date' => Carbon::now(),
            'punch_in' => '10:00:00',
            'punch_out' => '14:15:00',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '3',
            'user_id' => '1',
            'attend_date' => Carbon::yesterday(),
            'punch_in' => '11:00:00',
            'punch_out' => '15:45:00',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '4',
            'user_id' => '2',
            'attend_date' => Carbon::yesterday(),
            'punch_in' => '10:00:00',
            'punch_out' => '16:00:00',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
        ]);
    }
}
