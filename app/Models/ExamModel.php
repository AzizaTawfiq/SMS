<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ExamModel extends Model
{
    use HasFactory;
    protected $table = 'exam';
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord(){
         $return = self::select('exam.*','users.name as created_name')->
         join('users', 'users.id', '=', 'exam.created_by');
         if (!empty(Request::get('name'))) {
            $return = $return->where('exam.name', 'like', '%' . Request::get('name'). '%');
        }
        if (!empty(Request::get('note'))) {
            $return = $return->where('exam.note', 'like', '%' . Request::get('note'). '%');
        }
        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('exam.created_at', '=', Request::get('created_at'));
        }
         $return = $return-> where('exam.is_deleted', '=', 0)->
         orderBy('exam.id','desc')->paginate(20);
         return $return;
    }

    static public function getExam(){
         $return = self::select('exam.*')->
         join('users', 'users.id', '=', 'exam.created_by')->
         where('exam.is_deleted', '=', 0)->
         orderBy('exam.name','asc')->get();
         return $return;
    }

        static public function getTotalExam(){
         $return = self::select('exam.id')->
         where('exam.is_deleted', '=', 0)->
         count();
         return $return;
    }
}
