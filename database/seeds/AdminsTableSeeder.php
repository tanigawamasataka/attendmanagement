<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
           'name' => "鈴木 一郎",
           'password' => bcrypt('test1234'),
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now(),
            ]);
    }
}
