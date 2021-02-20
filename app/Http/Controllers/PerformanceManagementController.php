<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatePerformance;
use Illuminate\Http\Request;
use App\Performance;
use App\Timecard;
use App\User;
use App\School;
use DB;

class PerformanceManagementController extends Controller
{
     /**
     *実績管理ページの表示
     */
    public function showPerformanceManagement()
    {
        //実績をリレーションテーブルと一緒に取得
        $performances = Performance::with(['timecard.user.school'])->get();

        return view('/admin/performanceManagement', [
            'performances' => $performances,
        ]);
    }

    /**
     * 所属校と日時に合致した実績を表示
     */
    public function performanceManagement(Request $request)
    {
        //プルダウンメニューの所属校を取得
        $schools = $request->input('schools');

        //プルダウンメニューの選択した所属校を含むカラムを取得
        if (isset($schools)) 
        {
            //実績一覧をリレーション先の所属校で検索
            $performances = Performance::whereHas('timecard.user.school', function($query) use($schools){
                $query->where('id', $schools);
            })->get();
        } 

        //カレンダーの日時を取得   
        $attend_date = $request->input('attend_date');
    
        //カレンダー入力フォームで入力した日時を含むカラムを取得
        if (isset($attend_date))
        {
            //カレンダーに合致した実績をTimecardsテーブルから検索
            $performances = Performance::whereHas('timecard.user.school', function($query) use($attend_date, $schools){
                $query->where('attend_date', $attend_date)->where('id', $schools);
            })->get();
        } 

        return view('/admin/performanceManagement', [
            'performances' => $performances,
        ]);
    }

    /**
     * 新規実績登録利用者検索ページを表示
     */
    public function showUserListPerformanceRegister()
    {
         //利用者名を全て取得
         $users = User::all();

        return view('/admin/userListPerformanceRegister', [
            'users' => $users,
        ]);
    }

    /**
     * プルダウンメニューで所属校ごとに利用者を表示
     */
    public function userListPerformanceRegister(Request $request)
    {
        //プルダウンメニューの所属校を取得
        $school_id = $request->input('school');

        //プルダウンメニューの選択した所属校の利用者名を取得
        $users = User::where('school_id', $school_id)->get();

        //選ばれたユーザーの所属校を取得する
        $current_school = School::find($school_id);

        return view('/admin/userListPerformanceRegister', [
            'current_school' => $current_school,
            'users' => $users,
        ]);
    }

    /**
     * 新規実績登録、日付別検索ページを表示
     */
    public function showAttendanceForDate()
    {
        //タイムカードをリレーションテーブルと一緒に取得
        $timecards = Timecard::with(['user.school'])->take(30)->latest()->get();
        
        return view('/admin/attendanceForDate', [
            'timecards' => $timecards,
        ]);
    }

    /**
     * プルダウンメニューで日付ごとにTimecardを表示
     */
    public function attendanceForDate(Request $request)
    {
        //プルダウンメニューの所属校を取得
        $schools = $request->input('schools');

        //プルダウンメニューの選択した所属校を含むカラムを取得
        if (isset($schools)) 
        {
            //タイムカードをリレーション先の所属校で検索
            $timecards = Timecard::whereHas('user.school', function($query) use($schools){
                $query->where('id', $schools);
            })->get();
        } 

        //カレンダーの日時を取得   
        $attend_date = $request->input('attend_date');
    
        //カレンダー入力フォームで入力した日時を含むカラムを取得
        if (isset($attend_date))
        {
            //カレンダーに合致した実績をTimecardsテーブルから検索
            $timecards = Timecard::whereHas('user.school', function($query) use($attend_date, $schools){
                $query->where('attend_date', $attend_date)->where('id', $schools);
            })->get();
        } 

        return view('/admin/attendanceForDate', [
            'timecards' => $timecards,
        ]);
    }

    /**
     * 新規実績登録ページを日付別表示ページから取得
     */
    public function showPerformanceRegisterByAttendDate(int $timecard_id)
    {
        $timecard = Timecard::find($timecard_id);
        return view('/admin/performanceRegisterByAttendDate', [
            'timecard' => $timecard,
        ]);
    }

    /**
     * 日付別表示ページから新規実績登録
     */
    public function performanceCreateByAttendDate(Request $request)
    {
        //Performanceモデルのインスタンスを作成する
        $performance = new Performance();

        //サービス提供実績とタイムカードIDを代入する
        $performance->timecard_id = $request->timecard_id;
        $performance->meal_fg = $request->meal_fg;
        $performance->outside_fg = $request->outside_fg;
        $performance->medical_fg = $request->medical_fg;
        $performance->note = $request->note;

        //該当利用者の実績レコードが存在しないかをチェック
        $attend_date = strtotime($request->attend_date);
        $request->attend_date = date('Y-m-d', $attend_date);

        $records = Performance::wherehas('timecard', function($query) use($request){
            $query->where('user_id', $request->user_id)
            ->wheredate('attend_date', $request->attend_date);
        })->get();

        foreach( $records as $record)
        {
             //該当利用者のレコードが存在していた場合、エラーメッセージを保存して戻る
            if ($record != null) {
                return back()
                    ->with('error', '既に実績データが登録されています。');
            }
        }
        //インスタンスの状態をDBに書き込む
        $performance->save();
        
        return redirect()->route('attendanceForDate');
    }

    /**
     * 新規実績登録ページを表示
     */
    public function showPerformanceRegister(int $user_id)
    {
        //利用者情報を取得
        $user = User::find($user_id);

        return view('/admin/performanceRegister', [
            'user' => $user,
        ]);
    }   

    /**
     * 利用者別新規実績登録
     */
    public function performanceCreate(CreatePerformance $request)
    {
        DB::beginTransaction();
        try{
            //タイムカードと紐づいた実績のレコードを新規登録
            $timecard = new Timecard();
            $timecard->user_id = $request->user_id;
            $attend_date = strtotime($request->attend_date);
            $timecard->attend_date = date('Y-m-d', $attend_date);
            $timecard->punch_in = $request->punch_in;
            $timecard->punch_out = $request->punch_out;
            $timecard->status = $request->status;


            //該当利用者の実績レコードが存在しないかをチェック
            $attend_date = strtotime($request->attend_date);
            $request->attend_date = date('Y-m-d', $attend_date);

            $records = Performance::wherehas('timecard', function($query) use($request){
                $query->where('user_id', $request->user_id)
                ->wheredate('attend_date', $request->attend_date);
            })->get();

            foreach( $records as $record)
            {
                //該当利用者のレコードが存在していた場合、エラーメッセージをセッションに保存して戻る
                if ($record != null) {
                    return back()
                        ->with('error', '既に実績データが登録されています。');
                }
            }
            //インスタンスの状態をDBに書き込む
            $timecard->save();
            $timecard->performance()->create($request->all());

        } catch(Exception $e) {
            DB::rollback();
            return back()->withInput();
        }

        DB::commit();

        return redirect()->route('userListPerformanceRegister');
    }
}