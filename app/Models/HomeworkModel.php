<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class HomeworkModel extends Model
{
    use HasFactory;
    protected $table = 'homework';
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord(){
         $return = self::select('homework.*','users.name as created_name','school_classes.name as class_name','subjects.name as subject_name')->
         join('users', 'users.id', '=', 'homework.created_by')->
         join('school_classes','school_classes.id', '=', 'homework.class_id')->
         join('subjects','subjects.id', '=', 'homework.subject_id')->
         where('homework.is_deleted', '=' , 0);
         if (!empty(Request::get('class_name'))) {
            $return = $return->where('homework.class_id', 'like', '%' . Request::get('class_name'). '%');
        }
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
         $return = $return-> orderBy('homework.id','desc')->paginate(20);
         return $return;
    }
    static public function getRecordTeacher($class_ids){
         $return = self::select('homework.*','users.name as created_name','school_classes.name as class_name','subjects.name as subject_name')->
         join('users', 'users.id', '=', 'homework.created_by')->
         join('school_classes','school_classes.id', '=', 'homework.class_id')->
         join('subjects','subjects.id', '=', 'homework.subject_id')->
         whereIn('homework.class_id',$class_ids)->
         where('homework.is_deleted', '=' , 0);
         if (!empty(Request::get('class_name'))) {
            $return = $return->where('homework.class_id', 'like', '%' . Request::get('class_name'). '%');
        }
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
         $return = $return-> orderBy('homework.id','desc')->paginate(20);
         return $return;
    }

    static public function getRecordStudent($class_id){
         $return = self::select('homework.*','users.name as created_name','school_classes.name as class_name','subjects.name as subject_name')->
         join('users', 'users.id', '=', 'homework.created_by')->
         join('school_classes','school_classes.id', '=', 'homework.class_id')->
         join('subjects','subjects.id', '=', 'homework.subject_id')->
         where('homework.class_id', '=' ,$class_id)->
         where('homework.is_deleted', '=' , 0);

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
         $return = $return-> orderBy('homework.id','desc')->paginate(20);
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

}
