<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Student;
use App\AccountStudent;

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
}
