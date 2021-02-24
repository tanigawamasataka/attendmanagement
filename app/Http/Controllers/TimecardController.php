<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\User;
use App\Timecard;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class TimecardController extends Controller
{
    /**
     * トップページを表示
     */
    public function showTopPage()
    {
        //すべての所属校を取得する
        $schools = School::all();

        return view('/top', [
            'schools' => $schools,
        ]);
    }

    /**
     * 所属校に紐づく利用者リストを表示
     */
    public function showUserNameList(int $id)
    {   
        //選ばれた所属校を取得する
        $current_school = School::find($id);

        //選ばれた所属校に紐づくユーザーを取得する
        $users = User::where('school_id', $current_school->id)->get();

        return view('/timecard/userNameList', [
            'current_school' => $current_school,
            'current_school_id' => $current_school->id,
            'users' => $users,
        ]);
    }

    /**
     * 利用者リストに紐づくタイムカードを表示
     */
    public function showPunchList(int $user_id)
    {
        //選ばれたユーザーを取得する
        $current_user = User::find($user_id);

        //選ばれたユーザーの所属校を取得する
        $current_school = School::find($current_user->school_id);

        //今月、今日、今月の日数を取得
        $daysInMonth = Carbon::now()->daysInMonth;
        $thisMonth = Carbon::now()->month;
        $today = Carbon::today();
        
        //選ばれたユーザーに紐づくタイムカードを取得する
        $timecards = $current_user->timecards()->whereMonth('attend_date', $thisMonth)->get();
    
        //カレンダー表示用の日付を取得
        Carbon::setLocale('ja');
        $dates = CarbonPeriod::create(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        foreach($dates as $date)
        {
           $days[] = $date;
           $weeks[] = $date; 
        }
        $records = $days;
        
        //タイムカード表示用の配列代入処理
        foreach($timecards as $timecard)
        {       
            for ($n = 0; $n < $daysInMonth; $n++) {
                if ($records[$n] == $timecard->attend_date) {
                    $records[$n] = $timecard;
                }
            }
        }

        return view('/timecard/punchList', [
            //利用者情報
            'current_school_name' => $current_school->school_name,
            'current_user_name' => $current_user->name,
            'current_user_id' => $current_user->id,
            //カレンダー表示
            'days' => $days,
            'weeks' => $weeks,
            //タイムカード表示
            'records' => $records,
            'today' => $today,
        ]);
    }

    /**
     * 出席ボタン打刻
     */
    public function punchIn(int $user_id)
    {
        //選ばれたユーザーを取得する
        $current_user = User::find($user_id);

        //出席時間を15分切り上げで取得(9:00～9:15は9:30で打刻)
        Carbon::setLocale('ja');
        $punch_in_time = Carbon::now();

        if ($punch_in_time->between(Carbon::createFromTime(9, 00, 0), Carbon::createFromTime(9, 15, 0))) {
           $punch_in_time->addMinutes(30 - $punch_in_time->minute % 30);
        } else {
           $punch_in_time->addMinutes(15 - $punch_in_time->minute % 15);
        }
        
        //タイムカードテーブルにカラムを作成
        $timecards = Timecard::create([
            'user_id' => $current_user->id,
            'attend_date' => Carbon::now(),
            'punch_in' => $punch_in_time->format('H:i'),
            'status' => 2,
        ]);

        return redirect()->back();
    }

    /**
     * 退席ボタン打刻
     */
    public function punchOut(int $user_id)
    {
        //選ばれたユーザーを取得する
        $current_user = User::find($user_id);
        $timecard = Timecard::where('user_id', $current_user->id)->latest()->first();

        //退席時間を15分切り捨てで取得(16:15～16:30は16:00で打刻)
        $punch_out_time = Carbon::now();

        if ($punch_out_time->between(Carbon::createFromTime(16, 15, 0), Carbon::createFromTime(16, 30, 0))) {
            $punch_out_time->subMinutes(30 - $punch_out_time->minute % 30);
        } else {
            $punch_out_time->subMinutes($punch_out_time->minute % 15);
        }
        
        //タイムカードテーブルのカラムを更新
        $timecard->update([
            'punch_out' => $punch_out_time->format('H:i'),
            'status' => 3,
        ]);

        return redirect()->back();
        }
}