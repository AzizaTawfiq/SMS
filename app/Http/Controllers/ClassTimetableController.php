<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\School_Class;
use App\Models\Subject;
use App\Models\AssignSubject;
use App\Models\WeekModel;
use App\Models\ClassSubjectTimetableModel;
use Illuminate\Support\Facades\Auth;


class ClassTimetableController extends Controller
{
    public function list(Request $request)
    {
        $data['school_classes'] = School_Class::get();
        if(!empty($request->class_id)){
            $data['getSubject'] =  AssignSubject::MySubject($request->class_id);
        }
        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach($getWeek as $value){
            $weekData = array();
            $weekData['week_id'] = $value->id;
            $weekData['week_name'] = $value->name;

            if(!empty($request->class_id) && !empty($request->subject_id)){
                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($request->class_id, $request->subject_id, $value->id);
                if(!empty($classSubject)){
                    $weekData['start_time'] = $classSubject->start_time;
                    $weekData['end_time'] = $classSubject->end_time;
                    $weekData['room_number'] = $classSubject->room_number;
                } else {
                    $weekData['start_time'] = '';
                    $weekData['end_time'] = '';
                    $weekData['room_number'] = '';
                }
            } else {
                $weekData['start_time'] = '';
                $weekData['end_time'] = '';
                $weekData['room_number'] = '';
            }

            $week[] = $weekData;
        }
        $data['week'] = $week;
        return view('admin.class_timetable.list', $data);
    }

    public function getSubject( Request $request)
    {
       $getSubject =  AssignSubject::MySubject($request->class_id);
       $html="<option value=''>Select subject</option>";
       foreach($getSubject as $value){
            $html .= "<option value='" .$value->subject_id . "'>$value->subject_name</option>";
        }

        $json['html']= $html;
        echo json_encode($json);


    }

    public function insert_update(Request $request)
    {

        ClassSubjectTimetableModel::where('class_id','=',$request->class_id)->
        where('subject_id','=',$request->subject_id)->delete();
        foreach($request->timetable as $timetable){
            if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']))
            {
              $save= new ClassSubjectTimetableModel;
              $save->class_id = $request->class_id;
              $save->subject_id = $request->subject_id;
              $save->week_id = $timetable['week_id'];
              $save->start_time = $timetable['start_time'];
              $save->end_time = $timetable['end_time'];
              $save->room_number = $timetable['room_number'];
              $save->save();

            }
        }
        return redirect()->back()->with('success', 'Class timetable saved successfully');

    }
    public function myTimetable(Request $request)
    {
        $result = array();
        $getRecord = AssignSubject::MySubject(Auth::user()->class_id);
        foreach($getRecord as $value){
            $subjectData['name'] = $value->subject_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $weekVal){
                $weekData = array();
                $weekData['week_name'] = $weekVal->name;
                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject(
                    $value->class_id,
                    $value->subject_id,
                    $weekVal->id
                );

                if(!empty($classSubject)){
                    $weekData['start_time'] = $classSubject->start_time;
                    $weekData['end_time'] = $classSubject->end_time;
                    $weekData['room_number'] = $classSubject->room_number;
                } else {
                    $weekData['start_time'] = '';
                    $weekData['end_time'] = '';
                    $weekData['room_number'] = '';
                }
                $week[] = $weekData;
            }
            $subjectData['week'] = $week;
            $result[] = $subjectData;
        }

        // Add this temporary debug line
        dd($result);

        $data['getRecord'] = $result;
        return view('student.my_timetable', $data);
    }

    //teacher side
    public function myTimetableTeacher($class_id, $subject_id)
    {
        $data['getClass'] = School_Class::getSingle($class_id);
        $data['getSubject'] = Subject::getSingle($subject_id);
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $value){
                $weekData = array();
                $weekData['week_name'] = $value->name;
                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($class_id, $subject_id, $value->id);
                if(!empty($classSubject)){
                    $weekData['start_time'] = $classSubject->start_time;
                    $weekData['end_time'] = $classSubject->end_time;
                    $weekData['room_number'] = $classSubject->room_number;
                } else {
                    $weekData['start_time'] = '';
                    $weekData['end_time'] = '';
                    $weekData['room_number'] = '';
                }
                $result[] = $weekData;
            }

        $data['getRecord'] = $result;
        return view('teacher.my_timetable', $data);
    }
}
