<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class MarksGradeModel extends Model
{
    use HasFactory;
    protected $table = 'marks_grade';
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord(){
         $return = MarksGradeModel::select('marks_grade.*','users.name as created_name')->
         join('users', 'users.id', '=', 'marks_grade.created_by');
         if (!empty(Request::get('name'))) {
            $return = $return->where('marks_grade.name', 'like', '%' . Request::get('name'). '%');
        }
         $return = $return-> get();
         return $return;
    }
    static public function getGrade($percentage){
        $return = MarksGradeModel::select('marks_grade.*')->
        where('percent_from','<=', $percentage)->
        where('percent_to', '>=', $percentage)->
        first();
        return !empty($return->name) ? $return->name : '';
    }

}
