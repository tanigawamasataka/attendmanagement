<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['timecard_id','meal_fg','outside_fg','medical_fg','note',];
   /**
    * Timecardリレーション
    * 1対1
    */
    public function timecard()
    {
        return $this->belongsTo(Timecard::class);
    }

    /**
     * 実績のnoteカラム定義
     */
    const NOTE = [
        1 => [ 'label' => '通所', 'class' => 'label-primary' ],
        2 => [ 'label' => 'スカイプ', 'class' => 'label-success' ],
        3 => [ 'label' => 'メール', 'class' => 'label-info' ],
        4 => [ 'label' => '訪問', 'class' => 'label-warning' ],
    ];

    /**
     * noteの文字ラベルを取得
     * @return string
     */
    public function getNoteLabelAttribute()
    {
        // noteカラム値
        $note = $this->attributes['note'];

        // 定義されていなければ空文字を返す
        if (!isset(self::NOTE[$note])) {
            return '';
        }

        return self::NOTE[$note]['label'];
    }

    /**
     * noteの色クラスを取得
     * @return string
     */
    public function getNoteClassAttribute()
    {
        // noteカラム値
        $note = $this->attributes['note'];

        // 定義されていなければ空文字を返す
        if (!isset(self::NOTE[$note])) {
            return '';
        }

        return self::NOTE[$note]['class'];
    }
}