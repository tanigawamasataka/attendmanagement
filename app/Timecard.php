<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timecard extends Model
{
    protected $casts = ['attend_date' => 'date'];
    protected $fillable = ['user_id', 'attend_date', 'punch_in', 'punch_out', 'status'];

    /**
     * user関連付け
     * 多対1
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * performance関連付け
     * 1対1
     */
    public function performance()
    {
        return $this->hasOne(Performance::class);
    }

}