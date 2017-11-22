<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Announcements;
use App\Faculty;
use App\Student;
use App\AccountStudent;
use App\LoadGroupSchedule;
use App\LoadSubject;
use App\LoadGroup;
use App\Subject;

class Home extends Controller
{
  public function show_home($type){
    return view('home.home',['view_type' => $type]);
  }

  public function verify_login(Request $request){
    $post = $request->all();
    $username = $request['username'];
    $password = $request['password'];

    #-------------------------------------------------------
    // Find the student's account with the given username and password
    $account_student = AccountStudent::where('active', '=', '1')
    ->where('username', '=', $username)
    ->where('password', '=', $password)
    ->orderBy('id','DESC')
    ->first();

    #-------------------------------------------------------
    // Find the student's account with the given username but wrong password
    $check_username = AccountStudent::where('active', '=', '1')
    ->where('username', '=', $username)
    ->where('password', '!=', $password)
    ->orderBy('id','DESC')
    ->first();

    #-------------------------------------------------------
    // If the student's credentials match
    if($account_student){
      $request_result['result'] = 'existing';
      $request_result['id'] = $account_student->STUDENT_id;

      //------------------------------------------------------------------------
      // STORE SESSION VALUES PLEASE APPEN SES_ PREFIX IN SESSION VALUES
      // ALL UPPER CASE
      // THIS SESSIONS VALUES ARE REQUIRED and must be added upon login.
      session()->put('SES_AUTHENTICATED','YES');
      session()->put('SES_ACCOUNT_ID',$account_student->id);
      session()->put('SES_CICT_ID',$account_student->STUDENT_id);
      session()->put('SES_USERNAME',$account_student->username);
      //------------------------------------------------------------------------
    }

    #-------------------------------------------------------
    // If username exists but entered the wrong password
    else if($check_username){
      $request_result['result'] = 'wrong_pass';
    #-------------------------------------------------------
    // If account does not exists
    }else{
      $request_result['result'] = 'not_existing';
    }

    #-------------------------------------------------------
    // send response
    echo json_encode($request_result, JSON_FORCE_OBJECT);
  }

  public function get_all_announcements(){
    $collection = array();
    #------------------------------------------------------
    // get all announcements
    $all = Announcements::where('active','=',1)
    ->get();

    #------------------------------------------------------
    // if a announcement exists
    if($all){
      foreach ($all as $each) {
      $faculty = Faculty::where('id','=',$each->announced_by)
      ->where('active','=',1)
      ->first();

      $single_row = [];
      $single_row['all'] = $each;
      $single_row['faculty'] = $faculty;

      array_push($collection, $single_row);
      }
    }else{}

    #------------------------------------------------------
    // send response
    echo json_encode($collection, JSON_OBJECT_AS_ARRAY);
  }

  public function get_faculty_name(Request $request){
    $faculty = Faculty::where('last_name','like','%'. $request['txt_faculty_sched'] .'%')
    ->where('active','=',1)
    ->get();

    if($faculty->isEmpty()){
      $request = "No data";
    }else {
      $request = $faculty;
    }

    #--------------------------------------------------------
    echo json_encode($request, JSON_FORCE_OBJECT);
  }

  public function get_faculty_sched($id){
    $collection = array();
    #------------------------------------------------------
    // Get students subjects
    $load_group = LoadGroup::where('faculty', '=', $id)
    ->where('active', '=', '1')
    ->get();

    if($load_group->isEmpty()){
      $single_row['result'] = "No load_subjects";
      array_push($collection,$single_row);
    }else{
    #------------------------------------------------------
    //loop through each group
    foreach ($load_group as $each){
      #------------------------------------------------------
      //get schedule of subject if there is
      $load_group_schedule = LoadGroupSchedule::where('load_group_id', '=', $each->id)
      ->where('active', '=', '1')
      ->orderBy('class_start','DESC')
      ->get();

      $subject = Subject::where('id','=',$each->SUBJECT_id)
      ->where('active','=','1')
      ->get();

      #------------------------------------------------------
      $single_row  = [];
      $single_row['load_group'] = $each;
      $single_row['load_group_schedule'] = $load_group_schedule;
      $single_row['subject'] = $subject;

      array_push($collection,$single_row);
    }
  }
  #------------------------------------------------------
  // format collection
  $array_result = json_encode($collection,JSON_OBJECT_AS_ARRAY);

  #------------------------------------------------------
  // send result
  echo $array_result;
}

}
