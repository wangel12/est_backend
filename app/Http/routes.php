<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




    Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return View::make('advisor.adv_login');
    });
    Route::get('advisor/login', function() { return View::make('advisor.adv_login'); });
    Route::post('auth/login', 'Auth\CustomAuthController@postLogin'); 
    Route::get('advisor/logout', function(){ Auth::logout() ; return View::make('advisor.adv_login');});
    
    Route::get('advisor/register', 'AdvisorController@create');
    Route::post('advisor/register', 'AdvisorController@store'); 
    

});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web','auth']], function () {
    
    // All my routes that needs a logged in user  
    Route::get('advisor/notification', function(){
      return view("advisor.advisor_notification");
    });
    Route::get('advisor/manage_student', 'AdvisorController@listAllStudent');
    Route::get('advisor/student_detail/{id}', 'AdvisorController@getStudentDetail');
    Route::get('advisor/manage_volunteer_hour', 'AdvisorController@listStudentHour');
    Route::get('advisor/update_service_status/{id}/{status}', 'AdvisorController@updateServiceStatus');
    Route::get('advisor/update_student_status/{id}/{status}', 'AdvisorController@updateStudentStatus');
    Route::get('invite', function() { return View::make('advisor.advisor_invite'); });
    Route::get('service_detail/{id}','AdvisorController@dispaly_aggregate_edit_form' );
   
    
    Route::post('advisor/send_invitation','AdvisorController@sendEmailInvitation');
    Route::post('advisor/update_volunteer_hour','AdvisorController@updateStudentHour');
    Route::post('advisor/manage_volunteer_hour', 'AdvisorController@listStudentHourByYear');
    Route::post('advisor/search_student', 'AdvisorController@searchStdByName');
    Route::post('advisor/notify', 'AdvisorController@send_notification'); 
    Route::post('update_service_detail', 'AdvisorController@update_aggregate_edit_form'); 
    Route::post('delete_student/{id}','AdvisorController@destroy_student' );
    
    Route::resource('advisor','AdvisorController');
    Route::resource('service_type','ServiceTypeController');
    Route::resource('setting','SettingController');
    Route::resource('schoolYear','SchoolYearController');
    Route::resource('student_service','StudentController');
    Route::resource('school_email','SchoolEmailController');
     
});