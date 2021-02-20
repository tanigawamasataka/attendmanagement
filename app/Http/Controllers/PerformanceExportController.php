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
    public function export(int $user_id)
    {
        //個別実績ページの利用者名を取得
        $user = User::find($user_id);

        //今月、今日、今月の日数を取得
        $daysInMonth = Carbon::now()->daysInMonth;
        $thisMonth = Carbon::now()->month;
        $today = Carbon::today();
    
        //実績一覧をリレーション先で検索
        $performances = Performance::whereHas('timecard', function($query) use($user_id, $thisMonth){
            $query->where('user_id', $user_id)->whereMonth('attend_date', $thisMonth);
        })->get();
    
        //カレンダーを表示用の日付取得
        Carbon::setLocale('ja');
        $dates = CarbonPeriod::create(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        foreach($dates as $date)
        {    
            $days[] = $date;
            $weeks[] = $date; 
        }

        //実績表示用の配列代入処理
        $records = $days;
        foreach($performances as $performance) 
        {
            for ($n = 0; $n < $daysInMonth; $n++) {
                if ($records[$n] == $performance->timecard->attend_date) {
                    $records[$n] = $performance;
                }
            }
        }

        $view = \view('/admin/performanceExport', [
            'user' => $user,
            'today' => $today,
            'days' => $days,
            'weeks' => $weeks,
            'records' => $records,
        ]);
           
        return \Excel::download(new Export($view), 'performances.xlsx');
    }
}