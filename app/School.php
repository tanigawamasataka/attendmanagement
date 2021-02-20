<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /**
     * Users関連付け
     * 1対多
     */
    public function timecards()
    {
        return $this->hasMany(User::class);
    }
}