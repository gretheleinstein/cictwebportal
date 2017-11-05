<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\Grade;
use App\CurriculumSubject;
use App\Curriculum;

class Student_Grade extends Controller
{
  public function get_grade(Request $request){
    $id = $request->session()->get('SES_CICT_ID');

      $student = Student::where('active', '=', '1')
      ->where('cict_id', '=', $id)
      ->orderBy('id','DESC')
      ->first();

      $curriculum = Curriculum::where('active', '=', '1')
      ->where('id', '=', $student->CURRICULUM_id)
      ->orderBy('id','DESC')
      ->first();

      $curriculum_prep = Curriculum::where('active', '=', '1')
      ->where('id', '=', $student->PREP_id)
      ->orderBy('id','DESC')
      ->first();

      if($student->PREP_id == null){
        if($curriculum){
        $collection = array();
        $study_years = $curriculum->study_years;
        for($i=1; $i<=$study_years; $i++){
            $collection2 = array();
            for($e=1; $e<=2; $e++){
              $collection3 = array();
              $cur = CurriculumSubject::where('active', '=', '1')
                ->where('CURRICULUM_id', '=', $curriculum->id)
                ->where('year', '=', $i)
                ->where('semester', '=', $e)
                ->get();
                $recordCount = $cur->count();

                foreach ($cur as $each) {
                  $subject = Subject::where('active', '=', '1')
                    ->where('id', '=', $each->SUBJECT_id)
                    ->first();

                  $grade = Grade::where('active', '=', '1')
                    ->where('STUDENT_id', '=', $id)
                    ->where('SUBJECT_id', '=', $each->SUBJECT_id)
                    ->first();

                    // create container
                    $single_row = [];
                    $single_row['cur'] = $each;
                    $single_row['grade'] = $grade;
                    $single_row['subject'] = $subject;
                    array_push($collection3,$single_row);
                }

                $count['count'] = $recordCount;
                array_push($collection2,$collection3);
                array_push($collection2,$count);
            }
            // add to collection
            array_push($collection,$collection2);
          }
        // format collection
        $array_result = json_encode($collection,JSON_OBJECT_AS_ARRAY);
        // send result
        echo $array_result;
      }else{
        $data['result'] = 'curriculum_not_set';
        echo json_encode($data,JSON_FORCE_OBJECT);
      }
    }else if($student->PREP_id !== null){
        $collection = array();
        if($curriculum_prep){
          $study_years = $curriculum_prep->study_years;
          for($i=1; $i<=$study_years; $i++){
              $collection2 = array();
              for($e=1; $e<=2; $e++){
                $collection3 = array();
                $cur = CurriculumSubject::where('active', '=', '1')
                  ->where('CURRICULUM_id', '=', $curriculum_prep->id)
                  ->where('year', '=', $i)
                  ->where('semester', '=', $e)
                  ->get();
                  $recordCount = $cur->count();

                  foreach ($cur as $each) {
                    $subject = Subject::where('active', '=', '1')
                      ->where('id', '=', $each->SUBJECT_id)
                      ->first();

                    $grade = Grade::where('active', '=', '1')
                      ->where('STUDENT_id', '=', $id)
                      ->where('SUBJECT_id', '=', $each->SUBJECT_id)
                      ->first();
                      // create container
                      $single_row = [];
                      $single_row['cur'] = $each;
                      $single_row['grade'] = $grade;
                      $single_row['subject'] = $subject;
                      array_push($collection3,$single_row);
                  }

                  $count['count'] = $recordCount;
                  array_push($collection2,$collection3);
                  array_push($collection2,$count);
              }
              // add to collection
              array_push($collection,$collection2);
            }
        }else{
          $data['result'] = 'curriculum_not_set';
          echo json_encode($data,JSON_FORCE_OBJECT);
        }

        if($curriculum){
          $study_years = $curriculum->study_years;
          for($i=1; $i<=$study_years; $i++){
              $collection2 = array();
              for($e=1; $e<=2; $e++){
                $collection3 = array();
                $cur = CurriculumSubject::where('active', '=', '1')
                  ->where('CURRICULUM_id', '=', $curriculum->id)
                  ->where('year', '=', $i)
                  ->where('semester', '=', $e)
                  ->get();
                  $recordCount = $cur->count();

                  foreach ($cur as $each) {
                    $subject = Subject::where('active', '=', '1')
                      ->where('id', '=', $each->SUBJECT_id)
                      ->first();
                    $grade = Grade::where('active', '=', '1')
                      ->where('STUDENT_id', '=', $id)
                      ->where('SUBJECT_id', '=', $each->SUBJECT_id)
                      ->first();
                      // create container
                      $single_row = [];
                      $single_row['cur'] = $each;
                      $single_row['grade'] = $grade;
                      $single_row['subject'] = $subject;
                      array_push($collection3,$single_row);
                  }

                  $count['count'] = $recordCount;
                  array_push($collection2,$collection3);
                  array_push($collection2,$count);
              }
              // add to collection
              array_push($collection,$collection2);
            }
        }else{
          $data['result'] = 'curriculum_not_set';
          echo json_encode($data,JSON_FORCE_OBJECT);
        }

      // format collection
      $array_result = json_encode($collection,JSON_OBJECT_AS_ARRAY);
      // send result
      echo $array_result;
    }else{
      dd("error. wala ko makita");
    }

  }
}
