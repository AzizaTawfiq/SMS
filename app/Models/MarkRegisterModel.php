<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class MarkRegisterModel extends Model
{
    use HasFactory;
    protected $table = 'mark_register';

    static public function checkAlreadyMark($exam_id,$class_id,$student_id,$subject_id){
        return MarkRegisterModel::where('exam_id','=',$exam_id)->
        where('class_id','=',$class_id)->
        where('student_id','=',$student_id)->
        where('subject_id','=',$subject_id)->
        first();
    }

    static public function getExam($student_id)
    {
        return MarkRegisterModel::select('mark_register.*', 'exam.name as exam_name')->
        join('exam','exam.id', '=', 'mark_register.exam_id' )->
        where('mark_register.student_id', '=', $student_id)->
        groupBy('mark_register.exam_id')->
        get();
    }
    static public function getExamSubject($exam_id, $student_id)
    {
        return MarkRegisterModel::select('mark_register.*', 'exam.name as exam_name','subjects.name as subject_name')->
        join('exam','exam.id', '=', 'mark_register.exam_id' )->
        join('subjects','subjects.id', '=', 'mark_register.subject_id' )->
       /*  join('exam_schedule','exam_schedule.exam_id', '=', 'mark_register.exam_id')->
        join('exam_schedule as exam_schedule_class', 'exam_schedule_class.class_id', '=', 'mark_register.class_id')->
        join('exam_schedule as exam_schedule_subject', 'exam_schedule_subject.subject_id', '=', 'mark_register.subject_id')->
 */

        where('mark_register.exam_id', '=', $exam_id)->
        where('mark_register.student_id', '=', $student_id)->
        get();
    }
}
