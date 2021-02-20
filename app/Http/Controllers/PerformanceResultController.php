<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Performance;
use App\Timecard;
use App\User;
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
        return view('/admin/performanceEdit', [
            'performance' => $performance, 
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
    public function showIndividualPerformance(int $user_id)
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

        return view('/admin/individualPerformance', [
            'user' => $user,
            'days' => $days,
            'weeks' => $weeks,
            'records' => $records,
        ]);
    }
}