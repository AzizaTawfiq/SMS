<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Models\MarkRegisterModel;

class ExamScheduleModel extends Model
{
    use HasFactory;
    protected $table = 'exam_schedule';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getRecordSingle($exam_id, $class_id, $subject_id)
    {
        return ExamScheduleModel::where('exam_id', '=', $exam_id)->
        where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function deleteRecord($exam_id, $class_id)
    {
        ExamScheduleModel::where('exam_id', '=', $exam_id)->
        where('class_id', '=', $class_id)->delete();
    }

    static public function getExam($class_id)
    {
        return ExamScheduleModel::select('exam_schedule.*', 'exam.name as exam_name')->
        join('exam','exam.id', '=', 'exam_schedule.exam_id' )->
        where('exam_schedule.class_id', '=', $class_id)->
        groupBy('exam_schedule.exam_id')->
        orderBy('exam_schedule.id','asc')->get();
    }

    static public function getExamTimetable($exam_id, $class_id)
    {
        return ExamScheduleModel::select('exam_schedule.*','subjects.name as subject_name','subjects.type as subject_type')->
        join('subjects','subjects.id', '=', 'exam_schedule.subject_id' )->
        where('exam_schedule.exam_id', '=', $exam_id)->
        where('exam_schedule.class_id', '=', $class_id)->get();
    }

    static public function getSubject($exam_id, $class_id)
    {
        return ExamScheduleModel::select('exam_schedule.*','subjects.name as subject_name','subjects.type as subject_type')->
        join('subjects','subjects.id', '=', 'exam_schedule.subject_id' )->
        where('exam_schedule.exam_id', '=', $exam_id)->
        where('exam_schedule.class_id', '=', $class_id)->get();
    }

    static public function getExamTimetableTeacher($teacher_id)
    {
        return ExamScheduleModel::select('exam_schedule.*',
        'school_classes.name as class_name',
        'subjects.name as subject_name','exam.name as exam_name')
        ->join('assign_class_teacher','assign_class_teacher.class_id', '=', 'exam_schedule.class_id' )
        ->join('school_classes','school_classes.id', '=', 'exam_schedule.class_id' )
        ->join('subjects','subjects.id','=','exam_schedule.subject_id')
        ->join('exam','exam.id','=','exam_schedule.exam_id')
        ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
        ->get();
    }
    static public function getMark($exam_id, $class_id, $student_id, $subject_id)
    {
        return MarkRegisterModel::checkAlreadyMark($exam_id,$class_id,$student_id,$subject_id);

    }

}
