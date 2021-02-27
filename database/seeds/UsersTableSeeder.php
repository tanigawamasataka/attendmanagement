<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            ['id' => '1',
            'name' => '山田 太郎',
            'school_id' => '1',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '2',
            'name' => "鈴木 一郎",
            'school_id' => '2',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '3',
            'name' => "田中 次郎",
            'school_id' => '1',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '4',
            'name' => "渡辺 三郎",
            'school_id' => '2',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '5',
            'name' => "伊藤 四郎",
            'school_id' => '1',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '6',
            'name' => "佐藤 五郎",
            'school_id' => '2',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
        ]);
    }
}