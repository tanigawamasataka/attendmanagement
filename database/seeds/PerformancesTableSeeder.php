<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerformancesTableSeeder extends Seeder
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
            'meal_fg' => '1',
            'outside_fg' => '2',
            'medical_fg' => '2',
            'note' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '2',
            'timecard_id' => '2',
            'meal_fg' => '1',
            'outside_fg' => '2',
            'medical_fg' => '2',
            'note' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '3',
            'timecard_id' => '3',
            'meal_fg' => '1',
            'outside_fg' => '2',
            'medical_fg' => '2',
            'note' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '4',
            'timecard_id' => '4',
            'meal_fg' => '1',
            'outside_fg' => '2',
            'medical_fg' => '2',
            'note' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '5',
            'timecard_id' => '5',
            'meal_fg' => '1',
            'outside_fg' => '2',
            'medical_fg' => '2',
            'note' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '6',
            'timecard_id' => '6',
            'meal_fg' => '1',
            'outside_fg' => '2',
            'medical_fg' => '2',
            'note' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '7',
            'timecard_id' => '7',
            'meal_fg' => '1',
            'outside_fg' => '2',
            'medical_fg' => '2',
            'note' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['id' => '8',
            'timecard_id' => '8',
            'meal_fg' => '1',
            'outside_fg' => '2',
            'medical_fg' => '2',
            'note' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
        ]);
    }
}