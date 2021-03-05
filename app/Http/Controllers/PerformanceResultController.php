<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Performance;
use App\Timecard;
use App\User;
use App\Exports\Export;
use App\Http\Requests\EditPerformance;
use Request as PostRequest;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class PerformanceResultController extends Controller
{
    /**
     * 実績編集ページを表示
     */
    public function showPerformanceEdit(int $performance_id) 
    {
        //実績をリレーションテーブルと一緒に取得
        $performance = Performance::find($performance_id);

        //出席、退席時刻のプルダウン配列
        $punch_ins = ['09:30:00', '09:45:00', '10:00:00', '10:15:00', '10:30:00', '10:45:00', '11:00:00', '11:15:00', '11:30:00', '11:45:00', '12:00:00','12:15:00',
        '12:30:00', '12:45:00', '13:00:00', '13:15:00', '13:30:00', '13:45:00', '14:00:00', '14:15:00', '14:30:00', '14:45:00', '15:00:00', '15:15:00', '15:30:00', '15:45:00'];
        $punch_outs = ['09:45:00', '10:00:00', '10:15:00', '10:30:00', '10:45:00', '11:00:00', '11:15:00', '11:30:00', '11:45:00', '12:00:00','12:15:00','12:30:00',
        '12:45:00', '13:00:00', '13:15:00', '13:30:00', '13:45:00', '14:00:00', '14:15:00', '14:30:00', '14:45:00', '15:00:00', '15:15:00', '15:30:00', '15:45:00', '16:00:00'];

        return view('/admin/performanceEdit', [
            'performance' => $performance, 
            'punch_ins' => $punch_ins,
            'punch_outs' => $punch_outs,
        ]);
    } 

    /**
     * 実績情報の編集、削除
     */
    public function performanceEdit(int $performance_id, EditPerformance $request)
    {
        //編集対象の実績情報を取得
        $performance = Performance::find($performance_id);
    
        //編集対象の実績情報に入力値を詰めてsave
        if(PostRequest::get('update'))
        {
            DB::beginTransaction();
            try{
            //タイムカードと紐づいた実績のレコードを更新
            $timecard = $performance->timecard;

            //フォームの値を取得して連想配列を作成
            $form = array(
                    'name' => $request->name,
                    'attend_date' => $request->attend_date = date('Y-m-d', strtotime($request->attend_date)),
                    'punch_in' => $request->punch_in,
                    'punch_out' => $request->punch_out,
                    'meal_fg' => $request->meal_fg,
                    'outside_fg' => $request->outside_fg,
                    'medical_fg' => $request->medical_fg,
                    'note' => $request->note,
                    );

            unset( $form['_token'] );

            $performance->fill($form)->save();
            $timecard->fill($form)->save();

            } catch(Exception $e) {
               DB::rollback();
               return back()->withInput();
            }

        DB::commit();
        } 
        elseif(PostRequest::get('delete'))
        {
            $performance->delete();
        }

        return redirect()->route('performanceManagement');
    }

    /**
     * 個別実績ページを表示
     */
    public function showIndividualPerformance(int $user_id, int $timecard_id)
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

        return view('/admin/individualPerformance', [
            'timecard_id' => $timecard_id,
            'year' => $year,
            'month' => $month,
            'user' => $user,
            'days' => $days,
            'weeks' => $weeks,
            'records' => $records,
        ]);
    }
}