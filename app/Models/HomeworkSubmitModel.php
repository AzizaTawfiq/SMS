<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class HomeworkSubmitModel extends Model
{
    use HasFactory;
    protected $table = 'homework_submit';
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord($homework_id){
        $return = HomeworkSubmitModel::select('homework_submit.*','users.name as created_name','users.name as first_name', 'users.last_name')->
        join('users', 'users.id', '=', 'homework_submit.student_id')->
        where('homework_submit.homework_id', '=', $homework_id);
       if (!empty(Request::get('student_name'))) {
           $return = $return->where('users.name', '=', Request::get('student_name'));
       }
       if (!empty(Request::get('created_at'))) {
           $return = $return->whereDate('homework_submit.created_at', '=', Request::get('created_at'));
       }
        $return = $return-> orderBy('homework_submit.id','desc')->paginate(20);
        return $return;
   }

   static public function getHomeworkReport()
   {
         $return = HomeworkSubmitModel::select('homework_submit.*','school_classes.name as class_name',
         'subjects.name as subject_name', 'users.name as first_name','users.last_name')->
        join('users', 'users.id', '=', 'homework_submit.student_id')->
        join('homework', 'homework.id', '=', 'homework_submit.homework_id')->
        join('school_classes','school_classes.id', '=', 'homework.class_id')->
        join('subjects','subjects.id', '=', 'homework.subject_id');
        if (!empty(Request::get('first_name')))
        {
            $return = $return->where('users.name', '=', Request::get('first_name'));
        }
        if (!empty(Request::get('last_name')))
        {
            $return = $return->where('users.last_name', '=', Request::get('last_name'));
        }
        if (!empty(Request::get('class_name')))
        {
            $return = $return->where('school_classes.name', '=', Request::get('class_name'));
        }
         if (!empty(Request::get('subject_name')))
         {
            $return = $return->where('subjects.name', 'like', '%' . Request::get('subject_name'). '%');
        }
        if (!empty(Request::get('homework_date')))
        {
            $return = $return->whereDate('homework.homework_date', '=', Request::get('homework_date'));
        }
        if (!empty(Request::get('submission_date')))
         {
            $return = $return->whereDate('homework.submission_date', '=', Request::get('submission_date'));
        }
        if (!empty(Request::get('created_at')))
         {
            $return = $return->whereDate('homework.created_at', '=', Request::get('created_at'));
        }

         $return = $return-> orderBy('homework_submit.id','desc')->paginate(20);
         return $return;

   }

    static public function getRecordStudent($student_id){
        $return = HomeworkSubmitModel::select('homework_submit.*','school_classes.name as class_name','subjects.name as subject_name')->
        join('homework', 'homework.id', '=', 'homework_submit.homework_id')->
        join('school_classes','school_classes.id', '=', 'homework.class_id')->
        join('subjects','subjects.id', '=', 'homework.subject_id')->
        where('homework_submit.student_id', '=', $student_id);

        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subjects.name', 'like', '%' . Request::get('subject_name'). '%');
        }
        if (!empty(Request::get('homework_date'))) {
            $return = $return->whereDate('homework.homework_date', '=', Request::get('homework_date'));
        }
        if (!empty(Request::get('submission_date'))) {
            $return = $return->whereDate('homework.submission_date', '=', Request::get('submission_date'));
        }
        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('homework.created_at', '=', Request::get('created_at'));
        }
        $return = $return->orderBy('homework_submit.id','desc')->paginate(10);

        return $return;
    }

    public function getDocument()
    {
        if (!empty($this->document_file && file_exists('upload/homework/' . $this->document_file))) {
            return url('upload/homework/' . $this->document_file);
        } else {
            return "";
        }
    }

    public function getHomework() {
        return $this->belongsTo(HomeworkModel::class, 'homework_id');
    }
    public function getStudent() {
        return $this->belongsTo(User::class, 'student_id');
    }
    
    static public function getRecordStudentCount($student_id)
    {
        return HomeworkSubmitModel::where('student_id', '=', $student_id)->count();
    }

}
