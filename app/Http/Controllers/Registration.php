<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use App\AccountStudent;
use App\StudentProfile;

class Registration extends Controller
{
  /* Displays the reigstration view*/
  public function show_registration(){
    return view('registration.register');
  }

  /*Verify if a student is existing*/
  public function verify_student(Request $request){
    $post = $request->all();
    $stud_number = $request['stud_id'];
    echo "";

    // find the student with the given parameters
    $student = Student::where('id', '=', $stud_number)
    ->where('active', '=', '1')
    ->orderBy('id','DESC')
    ->first();

    if($student){
      // response
      $request_result['result'] = 'true';
      $request_result['id'] = $student->cict_id;
    }else{
      $request_result['result'] = 'false';
    }

    echo json_encode($request_result,JSON_FORCE_OBJECT);
  }

  public function check_account(Request $request){
     $post = $request->all();
     $cict_id = $request['cict_id'];

     // find the account student with the given parameters
     $account_student = AccountStudent::where('STUDENT_id', '=', $cict_id)
     ->where('active', '=', '1')
     ->orderBy('id','DESC')
     ->first();

     if($account_student){
       // response
       $request_result['result'] = 'true';
     }else{
       $request_result['result'] = 'false';
       $request_result['id'] = $cict_id;
     }

    echo json_encode($request_result,JSON_FORCE_OBJECT);
  }

  public function confirm_information(Request $request){
     $post = $request->all();
     $cict_id = $request['cict_id'];
     $last_name =  $request['last_name'];
     $first_name = $request['first_name'];
     $middle_name = $request['middle_name'];

     // find the student with the given parameters
     $student = Student::where('cict_id', '=', $cict_id)
     ->where('active', '=', 1)
     ->orderBy('id','DESC')
     ->first();

     if($student){
       $request_result['orig'] = $student->middle_name;
       if((empty($student->middle_name)) and ($request['middle_name'] == "")){
         $middle_name = "";
         $request_result['empty_md'] = $middle_name;
       }else{}
       if((is_null($student->middle_name)) and ($request['middle_name'] == "")){
         $middle_name = $request['middle_name'];
         $request_result['null_md'] = $middle_name;
       }else{}

       $student_credentials = Student::where('cict_id', '=', $student->cict_id)
       ->where('last_name', '=', $last_name)
       ->where('first_name', '=', $first_name)
       ->where('middle_name', '=', $middle_name)
       ->where('active', '=', 1)
       ->orderBy('id','DESC')
       ->first();
       $request_result['results'] = $middle_name;
       if($student_credentials){
          $request_result['result'] = 'true';
       }else {
          $request_result['result'] = 'false_name';
       }
     }else{
       $request_result['result'] = 'false';
     }



/*     if($student){
       // response
       $request_result['result'] = 'true';
       $request_result['r'] = $student->middle_name;
    //   $request_result['id'] = $student->cict_id;
     }else{
       $request_result['result'] = 'false';
     } */

    echo json_encode($request_result,JSON_FORCE_OBJECT);
  }

  public function check_username(Request $request){
     $post = $request->all();
     $username = $request['username'];

     // find the if the username is taken
     $account_student = AccountStudent::where('username', '=', $username)
     ->where('active', '=', '1')
     ->orderBy('id','DESC')
     ->first();

     if($account_student){
       // response
       $request_result['result'] = 'taken';
     }else{
       $request_result['result'] = 'available';
     }

    echo json_encode($request_result,JSON_FORCE_OBJECT);
  }

  public function create_account(Request $request){
    $student_id = $request['cict_id'];
    $username = $request['username'];
    $password = $request['password'];
    $question = $request['recovery_question'];
    $answer = $request['recovery_answer'];
    $floor_assignment = $request['floor_assignment'];

    $new_student = new AccountStudent();
    $new_student->STUDENT_id = $student_id;
    $new_student->username = $username;
    $new_student->password = $password;
    $new_student->recovery_question = $question;
    $new_student->recovery_answer = $answer;

    $res = $new_student->save();

    $student_profile = new StudentProfile();
    $student_profile->STUDENT_id = $student_id;
    $student_profile->floor_assignment = $floor_assignment;

    $profile_result = $student_profile->save();

    if($res and $profile_result){
      //response object
      $data['result'] = 'saved';
      $account_student = AccountStudent::where('active', '=', '1')
      ->where('STUDENT_id', '=', $student_id)
      ->orderBy('id','DESC')
      ->first();

      if($account_student) {
        //------------------------------------------------------------------------
        session()->put('SES_AUTHENTICATED','YES');
        session()->put('SES_ACCOUNT_ID',$account_student->id);
        session()->put('SES_CICT_ID',$account_student->STUDENT_id);
        session()->put('SES_USERNAME',$account_student->username);
        //------------------------------------------------------------------------
      }else{
        $data['result'] = 'failed';
      }

    }else{
      $data['result'] = 'failed';
    }

    echo json_encode($data,JSON_FORCE_OBJECT);
  }
}
