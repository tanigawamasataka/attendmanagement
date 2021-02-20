<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateUser;
use App\Http\Requests\EditUser;
use Illuminate\Http\Request;
use Request as PostRequest;
use App\School;
use App\User;
use App\Form;


class UserManagementController extends Controller
{
    /**
     * 利用者管理ページの表示
     */
    public function showUserManagementList()
    {
        //利用者名を全て取得
        $users = User::all();
    
        return view('/admin/userManagementList', [
            'users' => $users,
        ]);
    }

    /**
     * プルダウンメニューで所属校ごとに利用者を表示
     */
    public function userManagementList(Request $request)
    {
        //プルダウンメニューの所属校を取得
        $school_id = $request->input('school');

        //プルダウンメニューの選択した所属校の利用者名を取得
        $users = User::where('school_id', $school_id)->get();

        //選ばれたユーザーの所属校を取得する
        $current_school = School::find($school_id);

        return view('/admin/userManagementList', [
            'current_school' => $current_school,
            'users' => $users,
        ]);
    }

    /**
     * 新規利用者登録ページの表示
     */
    public function showUserRegister()
    {

        return view('/admin/userRegister');
    }

    /**
     * 新規利用者登録
     */
    public function userCreate(CreateUser $request)
    {
        //Userモデルのインスタンスを作成する
        $user = new User();

        //氏名と所属校に入力値を代入する
        $user->name = $request->name;
        $user->school_id = $request->radio;

        //インスタンスの状態をDBに書き込む
        $user->save();

        return redirect()->route('userManagementList');
    }
    
    /**
     * 利用者編集ページの表示
     */
    public function showUserEdit(int $user_id)
    {
        //利用者情報を取得
        $user = User::find($user_id);

        return view('/admin/userEdit', [
            'user' => $user,
        ]);
    }

    /**
     * 利用者情報の編集、削除
     */
    public function userEdit(int $user_id, EditUser $request)
    {
        //編集対象の利用者情報を取得
        $user = User::find($user_id);

        //編集対象の利用者情報に入力値を詰めてsave
        if(PostRequest::get('update'))
        {
            $user->name = $request->name;
            $user->school_id = $request->radio;
            $user->save();
        } 
        elseif(PostRequest::get('delete'))
        {
            $user->delete();
        }

        return redirect()->route('userManagementList');
    }

}