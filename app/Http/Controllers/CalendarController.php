<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignSubject;
use App\Models\ClassSubjectTimetableModel;
use App\Models\WeekModel;
use App\Models\ExamScheduleModel;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CalendarController extends Controller
{
    //student menu
    public function myCalendar()
    {
        $data['getMyTimetable'] = $this->getTimetable(Auth::user()->class_id);
        $data['getExamTimetable'] = $this->getExamTimetable(Auth::user()->class_id);
        return view('student.my_calendar',$data);
    }
    public function getTimetable($class_id)
    {
        $result = array();
        $getRecord = AssignSubject::MySubject($class_id);
        foreach($getRecord as $value){
            $subjectData['name'] = $value->subject_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $weekVal){
                $weekData = array();
                $weekData['week_name'] = $weekVal->name;
                $weekData['fullcalendar_day'] = $weekVal->fullcalendar_day;
                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject(
                    $value->class_id,
                    $value->subject_id,
                    $weekVal->id
                );

                if(!empty($classSubject)){
                    $weekData['start_time'] = $classSubject->start_time;
                    $weekData['end_time'] = $classSubject->end_time;
                    $weekData['room_number'] = $classSubject->room_number;
                    $week[] = $weekData;
                }
            }
            $subjectData['week'] = $week;
            $result[] = $subjectData;
        }
        return $result;
    }
    public function getExamTimetable($class_id)
    {
        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach($getExam as $value){
            $examData= array();
            $examData['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id,$class_id);
            $finalResult = array();
            foreach($getExamTimetable as $examTimetable){
                $examTimetableData= array();
                $examTimetableData['subject_name'] = $examTimetable->subject_name;
                $examTimetableData['exam_date'] = $examTimetable->exam_date;
                $examTimetableData['start_time'] = $examTimetable->start_time;
                $examTimetableData['end_time'] = $examTimetable->end_time;
                $examTimetableData['room_number'] = $examTimetable->room_number;
                $examTimetableData['full_mark'] = $examTimetable->full_mark;
                $examTimetableData['passing_mark'] = $examTimetable->passing_mark;
                $finalResult[]=$examTimetableData;
            }
            $examData['exam'] = $finalResult;
            $result[] = $examData;
        }
        return $result;
    }

    //teacher menu
    public function myCalendarTeacher()
    {
       $teacher_id = Auth::user()->id;
       $data['getClassTimetable'] = AssignClassTeacherModel::getMyCalendarTeacher($teacher_id);
       $data['getExamClassTimetable'] = ExamScheduleModel::getExamTimetableTeacher($teacher_id);
        return view('teacher.my_calendar',$data);
    }

}
