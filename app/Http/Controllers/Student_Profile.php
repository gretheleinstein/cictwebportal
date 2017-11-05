<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Student;
use App\AccountStudent;
use App\StudentProfile;
use App\Curriculum;
use App\AcademicTerm;
use DB; use PDF;
use Illuminate\Support\Facades\Route;

class Student_Profile extends Controller
{

  public function show_profile(){
    return view('profile.student_profile');
  }

  public function get_profile_details(Request $request){
    $id = $request->session()->get('SES_CICT_ID');

    $student = Student::where('active', '=', '1')
    ->where('cict_id', '=', $id)
    ->orderBy('id','DESC')
    ->first();

    $student_profile = StudentProfile::where('active', '=', '1')
    ->where('STUDENT_id', '=', $id)
    ->orderBy('id','DESC')
    ->first();

    $curriculum = Curriculum::where('active', '=', '1')
    ->where('id', '=', $student->CURRICULUM_id)
    ->orderBy('id','DESC')
    ->first();

    $academic_term = AcademicTerm::where('active', '=', '1')
    ->where('current', '=', 1)
    ->first();

    $reply['current_term'] =$academic_term;
    $reply['info'] =$student;
    $reply['profile'] =$student_profile;
    if($curriculum){
      $reply['curriculum'] =$curriculum;
    }else {
    }
    echo json_encode($reply,JSON_FORCE_OBJECT);
  }

  public function update_profile(Request $request){
    // get session with default value if no value was assigned
    $id = $request->session()->get('SES_CICT_ID');
    // same lang
    $post = $request->all();
    $gender = $request['gender'];
    $contact_no = $request['contact_no'];
    $zipcode = $request['zipcode'];
    $email = $request['email'];
    $house_no = $request['house_no'];
    $street = $request['street'];
    $brgy = $request['brgy'];
    $city = $request['city'];
    $province = $request['province'];
    $ice_name = $request['ice_name'];
    $ice_contact = $request['ice_contact'];
    $ice_address = $request['ice_address'];

    $student = Student::where('active', '=', '1')
    ->where('cict_id', '=',  $id)->orderBy('id','DESC')->first();
    $student->has_profile = 1;
    $student->gender = strtoupper($gender);
    $student_result = $student->save();

    $student_profile_record = StudentProfile::where('active', '=','1')
    ->where('STUDENT_id', '=', $id)->orderBy('id','DESC')->first();
    $student_profile_record->active = 0;
    $student_profile_record->save();

    $student_profile = new StudentProfile();
    $student_profile->STUDENT_id = $student_profile_record->STUDENT_id;
    $student_profile->floor_assignment = $student_profile_record->floor_assignment;
    $student_profile->profile_picture = $student_profile_record->profile_picture;
    $student_profile->mobile = strtoupper($contact_no);
    $student_profile->zipcode = strtoupper($zipcode);
    $student_profile->email = $email;
    $student_profile->house_no = strtoupper($house_no);
    $student_profile->street = strtoupper($street);
    $student_profile->brgy = strtoupper($brgy);
    $student_profile->city = strtoupper($city);
    $student_profile->province = strtoupper($province);
    $student_profile->ice_name = strtoupper($ice_name);
    $student_profile->ice_contact = strtoupper($ice_contact);
    $student_profile->ice_address = strtoupper($ice_address);

    $profile_result = $student_profile->save();

    if(($profile_result) && ($student_result)){
      //response object
      $data['result'] = 'saved';
    }else{
      $data['result'] = 'failed';
    }

    echo json_encode($data,JSON_FORCE_OBJECT);
  }

  public function view_pdf($id, Request $request){
    $student = Student::where('cict_id', '=', $id)
    ->where('active', '=', '1')
    ->orderBy('id','DESC')
    ->first();

    $student_profile = StudentProfile::where('STUDENT_id', '=', $id)
    ->where('active', '=', '1')
    ->orderBy('id','DESC')
    ->first();

    $academic_term = AcademicTerm::where('current', '=', 1)
    ->where('active', '=', '1')
    ->orderBy('id','DESC')
    ->first();

  //  $get_photo = $request->route('get-photo')->getActionName();
   //Route::getByName('get-photo');
    $get_photo = "http://localhost/laravel/cictwebportal/public/media/photo/";
    $display_pic = $get_photo.$student_profile->profile_picture;
    $get_sem = $academic_term->semester_regular;
    $get_sy = $academic_term->school_year;

    if($get_sem == 1){ $get_sem = "1st"; }
    else if ($get_sem == 2){ $get_sem = "2nd"; }
    else{ $get_sem = "Midyear"; }

    $view =\View::make('pdf.student_profile_pdf', ['student' => $student, 'student_profile' => $student_profile, 'display_pic' => $display_pic, 'sem' =>  $get_sem, 'sy' => $get_sy ]);
    $html_content = $view->render();
    //  PDF::new TCPDF('L', 'mm', array(210,97), true, 'UTF-8', false);
    PDF::SetTitle($student->last_name.', '.$student->first_name.' '.$student->middle_name);
    //  PDF::SetMargins(25,17,25, true);
    //  $resolution= array(165, 172);
    //  PDF::AddPage('P', $resolution);
    PDF::SetFont('gothic');
    PDF::AddPage();
    PDF::writeHTML($html_content, true, false, true, false, '');
    PDF::Output($student->last_name.', '.$student->first_name.' '.$student->middle_name.'.pdf');
  }

  public function logout(Request $request){
    $request->session()->flush();
  }

}
