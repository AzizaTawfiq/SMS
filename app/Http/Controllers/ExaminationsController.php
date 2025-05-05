<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ExamModel;
use App\Models\School_Class;
use App\Models\AssignSubject;
use App\Models\ExamScheduleModel;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ExaminationsController extends Controller
{
    public function exams_list()
    {
        $data['getRecord'] = ExamModel::getRecord();
        return view('admin.examinations.exam.list', $data);
    }

    public function exam_add()
    {
        return view('admin.examinations.exam.add');
    }
    public function exam_insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $exam = new ExamModel;
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', 'Exam added successfully');

    }

    public function exam_edit( $id)
    {
        $data['getRecord'] = ExamModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            return view('admin.examinations.exam.edit', $data);
        } else {
            abort(404);
        }

    }

    public function exam_update($id, Request $request)
    {
         $request->validate([
            'name' => 'required',
        ]);
        $exam=  ExamModel::getSingle($id);
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', 'Exam updated successfully');

    }

    public function exam_delete($id)
    {
        $exam = ExamModel::getSingle($id);
        if (!empty($exam)) {
            $exam->is_deleted=1;
            $exam->save();
            return redirect('admin/examinations/exam/list')->with('success', 'Exam deleted successfully');
        } else {
            abort(404);
        }
    }

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = School_Class::get();
        $data['getExam'] = ExamModel::getExam();
        $result = array();
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')) ){
            $getSubject = AssignSubject::MySubject($request->get('class_id'));
            foreach($getSubject as $subject){
             $subjectData = array();
             $subjectData['class_id'] = $subject->class_id;
             $subjectData['subject_id'] = $subject->subject_id;
             $subjectData['subject_name'] = $subject->subject_name;
             $subjectData['subject_type'] = $subject->subject_type;
             $examSchedule = ExamScheduleModel::getSingle($request->get('exam_id'), $request->get('class_id'),$subject->subject_id);
             if(!empty($examSchedule)){
                $subjectData['exam_date'] = $examSchedule->exam_date;
                $subjectData['start_time'] = $examSchedule->start_time;
                 $subjectData['end_time'] = $examSchedule->end_time;
                 $subjectData['room_number'] = $examSchedule->room_number;
                 $subjectData['full_mark'] = $examSchedule->full_mark;
                 $subjectData['passing_mark'] = $examSchedule->passing_mark;
            } else {
                 $subjectData['exam_date'] = '';
                 $subjectData['start_time'] = '';
                 $subjectData['end_time'] = '';
                 $subjectData['room_number'] = '';
                 $subjectData['full_mark'] = '';
                 $subjectData['passing_mark'] = '';

             }
             $result[]= $subjectData;
            }
        }
        $data['getRecord']= $result;
        return view('admin.examinations.exam_schedule', $data);
    }
    public function exam_schedule_insert(Request $request)
    {
        ExamScheduleModel::deleteRecord($request->exam_id, $request->class_id);
       if(!empty($request->schedule))
       {
        foreach($request->schedule as $schedule ){
            if(!empty($schedule['subject_id']) &&
             !empty($schedule['exam_date']) &&
             !empty($schedule['start_time']) &&
             !empty($schedule['end_time']) &&
             !empty($schedule['room_number']) &&
             !empty($schedule['full_mark'])

             )
            $exam = new ExamScheduleModel;
            $exam->exam_id = $request->exam_id;
            $exam->class_id = $request->class_id;
            $exam->subject_id = $schedule['subject_id'];
            $exam->exam_date = $schedule['exam_date'];
            $exam->start_time = $schedule['start_time'];
            $exam->end_time = $schedule['end_time'];
            $exam->room_number= $schedule['room_number'];
            $exam->full_mark = $schedule['full_mark'];
            $exam->passing_mark= $schedule['passing_mark'];
            $exam->created_by = Auth::user()->id;
            $exam->save();
        }
       }
       return redirect()->back()->with('success', 'Exam schedule added successfully');
    }

    //student menu
    public function myExamTimetable(){
        $class_id = Auth::user()->class_id;
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
        $data['getRecord']= $result;
        return view('student.my_exam_timetable', $data);

    }

    //teacher menu
    public function myExamTimetableTeacher(){

        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $result = array();
        foreach($getClass as $class){
            $classData= array();
            $classData['class_name'] = $class->class_name;
            $getExam = ExamScheduleModel::getExam($class->class_id);
            $finalResult = array();
            foreach($getExam as $exam){
                $examData= array();
                $examData['exam_name'] = $exam->exam_name;
                $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id,$class->class_id);
                $subjectData = array();
                foreach($getExamTimetable as $examTimetable){
                    $examTimetableData= array();
                    $examTimetableData['subject_name'] = $examTimetable->subject_name;
                    $examTimetableData['exam_date'] = $examTimetable->exam_date;
                    $examTimetableData['start_time'] = $examTimetable->start_time;
                    $examTimetableData['end_time'] = $examTimetable->end_time;
                    $examTimetableData['room_number'] = $examTimetable->room_number;
                    $examTimetableData['full_mark'] = $examTimetable->full_mark;
                    $examTimetableData['passing_mark'] = $examTimetable->passing_mark;
                    $subjectData[]=$examTimetableData;
                }
                $examData['subject']=$subjectData;
                $finalResult[]=$examData;
            }
            $classData['exam'] = $finalResult;
            $result[] = $classData;
        }
        $data['getRecord']= $result;
        return view('teacher.my_exam_timetable', $data);
    }

}
