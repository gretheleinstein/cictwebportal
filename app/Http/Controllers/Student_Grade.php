<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Subject;
use App\Grade;
use App\Evaluation;
use App\AcademicTerm;

class Student_Grade extends Controller
{
  public function get_grade(Request $request){
    $collection = array();
    $id = $request->session()->get('SES_CICT_ID');

    #------------------------------------------------------
    // Get the evaluation records of student
    $eval = Evaluation::where('STUDENT_id', '=', $id)
    ->where('active','=','1')
    ->where('remarks','=','ACCEPTED')
    ->get();

    if($eval){
      // Loop through every evaluation record
      foreach ($eval as $each){
        $collection2 = array();

        #------------------------------------------------------
        // Get academic term record
        $acad = AcademicTerm::where('id','=',$each->ACADTERM_id)
        ->where('active','=','1')
        ->first();

        #------------------------------------------------------
        // Get grades on each academic term
        $grade = Grade::where('STUDENT_id','=',$id)
        ->where('ACADTERM_id','=',$each->ACADTERM_id)
        ->where('active','=','1')
        ->get();

        if($grade->isEmpty()){
          // if grades is empty
          $single['result'] = "No grade record of student";
          array_push($collection2,$single);
        }else{
          // Loop through each grades and get data and corresponding subject info
          foreach ($grade as $each_grade){
            $subject = Subject::where('id','=',$each_grade->SUBJECT_id)
            ->where('active','=','1')
            ->first();

            $grades_row['grade'] = $each_grade;
            $grades_row['subject'] = $subject;

            array_push($collection2,$grades_row);
          }
        }

        $single_row = [];
        $single_row['eval'] = $each;
        $single_row['acad'] = $acad;

        #------------------------------------------------------
        //push grades on each row
        array_push($single_row,$collection2);
        array_push($collection,$single_row);
      }
    }else{
      $single_row['result'] = "No evaluation record of student";
      array_push($collection,$single_row);
    }

    #------------------------------------------------------
    // format collection
    $array_result = json_encode($collection,JSON_OBJECT_AS_ARRAY);

    #------------------------------------------------------
    // send result
    echo $array_result;
  }
}
