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
         $return = self::select('marks_grade.*','users.name as created_name')->
         join('users', 'users.id', '=', 'marks_grade.created_by');
         if (!empty(Request::get('name'))) {
            $return = $return->where('marks_grade.name', 'like', '%' . Request::get('name'). '%');
        }


        if (!empty(Request::get('created_at'))) {
            $return = $return->whereDate('marks_grade.created_at', '=', Request::get('created_at'));
        }
         $return = $return-> get();
         return $return;
    }


}
