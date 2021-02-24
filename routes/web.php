<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*トップページ*/
Route::get('/top', 'TimecardController@showTopPage')->name('top');

/*利用者リストページ*/
Route::get('/timecard/{id}/userNameList', 'TimecardController@showUserNameList')->name('userNameList');

/*タイムカード打刻ページ*/
Route::get('/timecard/{user_id}/punchList', 'TimecardController@showPunchList')->name('punchList');
Route::post('/timecard/{user_id}/punchIn', 'TimecardController@punchIn')->name('timecard/punchIn');
Route::post('/timecard/{user_id}/punchOut', 'TimecardController@punchOut')->name('timecard/punchOut');

/*管理者ログインページ*/
Route::get('/auth/login', 'AdminController@showLoginForm')->name('admin.login');

Route::group(['middleware' => 'auth'], function() {
    /*アドミントップ*/  
    Route::get('/admin/adminTop', 'AdminController@showAdminTop')->name('admin.top');

    /*利用者管理ページ*/
    Route::get('/admin/userManagementList', 'UserManagementController@showUserManagementList')->name('userManagementList');
    Route::post('/admin/userManagementList', 'UserManagementController@userManagementList');
    
    /*新規利用者登録ページ*/
    Route::get('/admin/userRegister', 'UserManagementController@showUserRegister')->name('userRegister');
    Route::post('/admin/userRegister', 'UserManagementController@userCreate');

    /*利用者編集ページ*/
    Route::get('/admin/{user_id}/userEdit', 'UserManagementController@showUserEdit')->name('userEdit');
    Route::post('/admin/{user_id}/userEdit', 'UserManagementController@userEdit');

    /*実績管理ページ*/
    Route::get('/admin/performanceManagement', 'PerformanceManagementController@showPerformanceManagement')->name('performanceManagement');
    Route::post('/admin/performanceManagement', 'PerformanceManagementController@performanceManagement');
    
    /*新規実績登録利用者一覧ページ*/
    Route::get('/admin/userListPerformanceRegister', 'PerformanceManagementController@showUserListPerformanceRegister')->name('userListPerformanceRegister');
    Route::post('/admin/userListPerformanceRegister', 'PerformanceManagementController@userListPerformanceRegister');

    /*日付別出席者一覧ページ*/
    Route::get('/admin/attendanceForDate', 'PerformanceManagementController@showAttendanceForDate')->name('attendanceForDate');
    Route::post('/admin/attendanceForDate', 'PerformanceManagementController@attendanceForDate');

    /*日付別新規実績登録ページ*/
    Route::get('/admin/{timecard_id}/performanceRegisterByAttendDate', 'PerformanceManagementController@showPerformanceRegisterByAttendDate')->name('performanceRegisterByAttendDate');
    Route::post('/admin/{timecard_id}/performanceRegisterByAttendDate', 'PerformanceManagementController@performanceCreateByAttendDate');
    
    /*新規実績登録ページ*/
    Route::get('/admin/{user_id}/performanceRegister', 'PerformanceManagementController@showPerformanceRegister')->name('performanceRegister');
    Route::post('/admin/{user_id}/performanceRegister', 'PerformanceManagementController@performanceCreate');

    /*利用者編集ページを表示*/
    Route::get('/admin/{performance_id}/performanceEdit', 'PerformanceResultController@showPerformanceEdit')->name('performanceEdit');
    Route::post('/admin/{performance_id}/performanceEdit', 'PerformanceResultController@performanceEdit');

    /*利用者別実績管理ページを表示*/
    Route::get('/admin/{user_id}/individualPerformance/{timecard_id}', 'PerformanceResultController@showIndividualPerformance')->name('individualPerformance');

    /*実績記録のExcel出力*/
    Route::get('/admin/{user_id}/export/{timecard_id}', 'PerformanceExportController@export')->name('performanceExport');
});

/*ログイン認証*/
Auth::routes();