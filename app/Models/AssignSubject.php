<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;
    protected $table = 'subject_school_class';
    protected $fillable = ['schoolclass_id','subject_id','status','user_id'];
    
    static public function MySubject($class_id){
        return self::select('subject_school_class.*','subjects.name as subject_name','subjects.type as subject_type')
           ->join('subjects','subjects.id','=','subject_school_class.schoolclass_id')
           ->join('users','users.id','=','subject_school_class.user_id')
           ->where('subject_school_class.schoolclass_id','=',$class_id)
           ->where('subject_school_class.deleted_at','=',null)
           ->where('subject_school_class.status','=',0)
           ->orderBy('subject_school_class.id','desc')
           ->get();
    }
}
