<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class FeesStudentModel extends Model
{
    use HasFactory;
    protected $table = 'fees_student';
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getFees($student_id){
        $return = self::select('fees_student.*', 'school_classes.name as class_name',
        'users.name as created_name')->
        join('school_classes', 'school_classes.id', '=', 'fees_student.class_id')->
        join('users', 'users.id', '=', 'fees_student.created_by')->
        where('fees_student.student_id', '=', $student_id)->
        get();
        return $return;
   }

   static public function getPaidAmount($student_id,$class_id){
    $return = self::where('fees_student.student_id', '=', $student_id)->
    where('fees_student.class_id', '=', $class_id)->
    sum('fees_student.paid_amount');
    return $return;
    }

}
