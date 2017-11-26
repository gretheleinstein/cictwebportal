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

Route::get('/', function () {
  return view('welcome');
});

// use this in postman for csrf token
Route::get('show_token',function(){
  echo csrf_token();
});

//404 PAGE
Route::get('page_not_found','Error@show_404')->name('error-404');
//STATUS CODE
Route::get('status_error/{status}','Error@show_status_error')->name('error-status');

// ROUTES FOR GUEST USERS
Route::group(['middleware' => ['cict.guest']], function () {

  //HOME
  Route::get('home/{type}','Home@show_home')->name('home');
  Route::post('home/verify','Home@verify_login')->name('login-verify');
  Route::post('home/announcements','Home@get_all_announcements')->name('get-all-anno');
  Route::post('home/faculty_name','Home@get_faculty_name')->name('get-faculty-name');
  Route::post('home/faculty_sched/{id}','Home@get_faculty_sched')->name('get-faculty-sched');

  //REGISTRATION
  Route::get('registration/register','Registration@show_registration')->name('register');
  Route::post('registration/verify','Registration@verify_student')->name('register-verify');
  Route::post('registration/check_account','Registration@check_account')->name('register-check-account');
  Route::post('registration/confirm','Registration@confirm_information')->name('register-confirm');
  Route::post('registration/check_username','Registration@check_username')->name('register-check-username');
  Route::post('registration/create','Registration@create_account')->name('register-create');

  //FORGOT PASSWORD
  Route::get('forgot_password','Forgot_Password@show_forgot_pass')->name('forgot-pass');
  Route::post('forgot_password/verify','Forgot_Password@verify_student')->name('forgot-pass-verify');
  Route::post('forgot_password/get_question','Forgot_Password@get_question')->name('forgot-pass-get');
  Route::post('forgot_password/check_answer','Forgot_Password@verify_answer')->name('forgot-pass-check-answer');
  Route::post('forgot_password/set_new_password','Forgot_Password@reset_password')->name('forgot-pass-reset');

});

// ROUTES THAT REQUIRES LOGGED IN USER
Route::group(['middleware' => ['cict.auth']], function () {

  Route::get('student_profile','Student_Profile@show_profile')->name('profile');
  Route::post('student_profile/update','Student_Profile@update_profile')->name('profile-update');
  Route::post('get_profile','Student_Profile@get_profile_details')->name('profile-get');
  Route::post('logout','Student_Profile@logout')->name('profile-logout');
  Route::get('student_profile/{id}/PDF/view_pdf', 'Student_Profile@view_pdf')->name('pdf-view');
  Route::get('get_grade','Student_Grade@get_grade')->name('grade-get');
  Route::get('get_summary','Student_Summary@get_summary')->name('summary-get');
  Route::get('view_eval','Student_Evaluation_History@view_eval')->name('eval-get');
  Route::get('view_schedule','Student_Schedule@view_sched')->name('sched-get');
  Route::get('schedule_info','Student_Schedule@get_current_term')->name('sched-info-get');
  Route::post('student_profile/set_new_password','Settings@reset_password')->name('settings-pass-reset');
  Route::post('student_profile/change_floor_assignment','Settings@change_floor_assignment')->name('settings-change-flr');

});

//LINKED SETTINGS
  Route::get('get_floor_name','Linked_Settings@get_floor_name')->name('get-floor-name');

// MEDIA ROUTES
  Route::get('media/photo/{photo}','Media@get_photo')->name('get-photo');
  Route::get('media/app','Media@get_app')->name('get-app');
  Route::post('media/upload','Media@upload_photo')->name('upload-photo');

// EXTERNAL ROUTES
	Route::get('linked/api/{cict_id}', function($cict_id){
		ini_set("allow_url_fopen",1);
		$json = file_get_contents('http://localhost/laravel/linked/public/linked/check_number/'.$cict_id);
    echo $json;
	})->name('check-number');
