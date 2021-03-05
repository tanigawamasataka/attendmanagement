<?php

namespace App\Http\Controllers;

use App\Performance;
use App\Timecard;
use App\User;
use App\Exports\Export;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class PerformanceExportController extends Controller
{

    /**
     * 実績記録のエクスポート
     */
    public function export(int $user_id, int $timecard_id)
    {
        //個別実績ページの利用者名と出席日を取得
        $user = User::find($user_id);
        $timecard = Timecard::find($timecard_id);
        $attend_date = $timecard->attend_date;

        //出席日を年月日に分割
        list($year, $month, $day) = explode('-', $attend_date);
        $daysInMonth = Carbon::create($year, $month, 1)->endOfMonth();

        //実績一覧をリレーション先で検索
        $performances = Performance::whereHas('timecard', function($query) use($user_id, $attend_date){
            $query->where('user_id', $user_id)->whereMonth('attend_date', $attend_date);
        })->get();
    
        //カレンダーを表示用の日付取得
        Carbon::setLocale('ja');
        $dates = CarbonPeriod::create(Carbon::create($year, $month, 1)->startOfMonth(), Carbon::create($year, $month, 1)->endOfMonth());
        foreach($dates as $date)
        {    
            $days[] = $date;
            $weeks[] = $date; 
        }

        //実績表示用の配列代入処理
        $records = $days;
        foreach($performances as $performance) 
        {
            for ($n = 0; $n < mb_substr($daysInMonth, 8,2); $n++) {
                if ($records[$n] == $performance->timecard->attend_date) {
                    $records[$n] = $performance;
                }
            }
        }
        
        $view = \view('/admin/performanceExport', [
            'year' => $year,
            'month' => $month,
            'user' => $user,
            'days' => $days,
            'weeks' => $weeks,
            'records' => $records,
        ]);
           
        return \Excel::download(new Export($view), $user->name.' '.$year.'年'.ltrim($month, "0").'月分.xlsx');
    }
}