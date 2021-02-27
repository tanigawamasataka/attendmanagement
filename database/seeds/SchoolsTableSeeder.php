<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
            'id' => '1',
            'school_name' => "本校",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);

        DB::table('schools')->insert([
            'id' => '2',
            'school_name' => "本町2校",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
     }
}