<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\LoadGroupSchedule;
use App\LoadSubject;
use App\Subject;

class Student_Schedule extends Controller
{
  public function view_sched(Request $request){
    $collection = array();
    $id = $request->session()->get('SES_CICT_ID');

    $load_subject = LoadSubject::where('STUDENT_id', '=', $id)
    ->where('active', '=', '1')
    ->orderBy('id','DESC')
    ->get();

/*    $load_group_schedule = LoadGroupSchedule::where('load_group_id', '=', 29203)
    ->where('active', '=', '1')
    ->orderBy('class_day','DESC')
    ->get(); */
    $n = 1;
    foreach ($load_subject as $each){
      $subject = Subject::where('id','=',$each->SUBJECT_id)
      ->where('active','=','1')
      ->first();

      $load_group_schedule = LoadGroupSchedule::where('load_group_id', '=', $each->LOADGRP_id)
      ->where('active', '=', '1')
      ->first();

      $single_row = [];
      $single_row['subject'] = $subject;
      $single_row['load_group_schedule'] = $load_group_schedule;

      array_push($collection,$single_row);
      $n++;
    }
  // format collection
  $array_result = json_encode($collection,JSON_OBJECT_AS_ARRAY);
  // send result
  echo $array_result;
  }
}
