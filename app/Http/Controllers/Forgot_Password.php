<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use App\AccountStudent;
use App\StudentProfile;

class Forgot_Password extends Controller
{
  public function show_forgot_pass(){
    return view('forgot_password.forgot_pass');
  }

  public function verify_student(Request $request){
    $post = $request->all();
    $stud_username = $request['stud_username'];

    // find the student with the given parameters
    $account_student = AccountStudent::where('username', '=', $stud_username)
    ->where('active', '=', '1')
    ->orderBy('id','DESC')
    ->first();

    if($account_student){
      // response
      $request_result['result'] = 'true';
      session()->put('SES_ID_FOR_QUESTION', $account_student->STUDENT_id);
    }else{
      $request_result['result'] = 'false';
    }

    echo json_encode($request_result,JSON_FORCE_OBJECT);
  }

  public function get_question(Request $request){
    $id = $request->session()->get('SES_ID_FOR_QUESTION');

     // find the account student with the given parameters
     $account_student = AccountStudent::where('STUDENT_id', '=', $id)
     ->where('active', '=', '1')
     ->orderBy('id','DESC')
     ->first();

     if($account_student){
       // response
       $request_result['result'] = 'true';
       $request_result['question'] = $account_student->recovery_question;
     }else{
       $request_result['result'] = 'false';
     }

    echo json_encode($request_result,JSON_FORCE_OBJECT);
  }

  public function verify_answer(Request $request){
    $post = $request->all();
    $answer = $request['recovery_answer'];
    $id = $request->session()->get('SES_ID_FOR_QUESTION');

     $account_student = AccountStudent::where('recovery_answer',$answer)
     ->where('STUDENT_id', '=',  $id)
     ->where('active', '=', '1')
     ->orderBy('id','DESC')
     ->first();

     if($account_student){
       $request_result['result'] = 'true';
     }else{
       $request_result['result'] = 'false';
     }

    echo json_encode($request_result,JSON_FORCE_OBJECT);
  }

  public function reset_password(Request $request){
    $post = $request->all();
    $new_password = $request['password'];
    $id = $request->session()->get('SES_ID_FOR_QUESTION');

      $account_student = AccountStudent::where('STUDENT_id', '=', $id)
      ->where('active', '=', '1')
      ->orderBy('id','DESC')
      ->take(1)
      ->update(['password' => $new_password,]);

      if($account_student){
        $request_result['result'] = 'saved';
      }else{
        $request_result['result'] = 'failed';
      }

     echo json_encode($request_result,JSON_FORCE_OBJECT);
  }
}
