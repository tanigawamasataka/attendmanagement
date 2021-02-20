<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    /**
     * 利用者テーブル
     */
    protected $table = 'users';

    /**
     * 論理削除
     */
    protected $dates = ['deleted_at'];

    /**
     * Timecards関連付け
     * 1対多
     */
    public function timecards()
    {
        return $this->hasMany(Timecard::class);
    }

    /**
     * School関連付け
     * 多対1
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}