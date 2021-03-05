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
            'name' => "田中 花子",
            'school_id' => '1',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '4',
            'name' => "渡辺 和也",
            'school_id' => '2',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '5',
            'name' => "伊藤 幸子",
            'school_id' => '1',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '6',
            'name' => "田口 大輔",
            'school_id' => '2',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '7',
            'name' => "中村 卓也",
            'school_id' => '1',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '8',
            'name' => "植木 恵子",
            'school_id' => '2',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '9',
            'name' => "白井 直樹",
            'school_id' => '1',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
            ['id' => '10',
            'name' => "東山 綾子",
            'school_id' => '2',
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
        ]);
    }
}