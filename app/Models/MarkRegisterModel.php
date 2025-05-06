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
}
