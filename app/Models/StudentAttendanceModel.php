<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class StudentAttendanceModel extends Model
{
    use HasFactory;
    protected $table = 'student_attendance';
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function checkAlreadyAttendance($student_id, $class_id, $attendance_date){
         $return = StudentAttendanceModel::where('student_id','=',$student_id )
         ->where('class_id','=',$class_id )
         ->where('attendance_date','=',$attendance_date)->first();
         return $return;
    }

    static public function getRecord($remove_pagination = 0) {
        $return = StudentAttendanceModel::select('student_attendance.*','student.name as student_name',
        'student.last_name as student_last_name','school_classes.name as class_name'
        ,'created_by.name as created_name')
        ->join('users as student', 'student.id', '=', 'student_attendance.student_id')
        ->join('school_classes','school_classes.id','=','student_attendance.class_id')
        ->join('users as created_by','created_by.id','=','student_attendance.created_by');
        if (!empty(Request::get('class_id'))) {
           $return = $return->where('student_attendance.class_id', 'like', '%' . Request::get('class_id'). '%');
       }
        if (!empty(Request::get('student_name'))) {
           $return = $return->where(function($query) {
               $query->where('student.name', 'like', '%' . Request::get('student_name'). '%')
                     ->orWhere('student.last_name', 'like', '%' . Request::get('student_name'). '%');
           });
       }
        if (!empty(Request::get('attendance_type'))) {
           $return = $return->where('student_attendance.attendance_type', 'like', '%' . Request::get('attendance_type'). '%');
       }
       if (!empty(Request::get('attendance_date'))) {
           $return = $return->whereDate('student_attendance.attendance_date', '=', Request::get('attendance_date'));
       }
        $return = $return->orderBy('student_attendance.id', 'desc');
        if (!empty($remove_pagination)) 
        {
            $return = $return->get();
        } else {
            $return = $return->paginate(4);
        }
        return $return;
   }

    static public function getRecordStudent($student_id){
        $return = StudentAttendanceModel::select('student_attendance.*','school_classes.name as class_name')
        ->join('school_classes','school_classes.id','=','student_attendance.class_id')
        ->where('student_attendance.student_id','=',$student_id);
        if (!empty(Request::get('class_id'))) {
            $return = $return->where('student_attendance.class_id', 'like', '%' . Request::get('class_id'). '%');
        }
         if (!empty(Request::get('attendance_type'))) {
            $return = $return->where('student_attendance.attendance_type', 'like', '%' . Request::get('attendance_type'). '%');
        }
        if (!empty(Request::get('attendance_date'))) {
            $return = $return->whereDate('student_attendance.attendance_date', '=', Request::get('attendance_date'));
        }
        $return = $return-> orderBy('student_attendance.id','desc')->paginate(20);
        return $return;
   }
    static public function getClassStudent($student_id){
        return StudentAttendanceModel::select('student_attendance.*','school_classes.name as class_name')
        ->join('school_classes','school_classes.id','=','student_attendance.class_id')
        ->where('student_attendance.student_id','=',$student_id)
        ->groupBy('student_attendance.class_id')->get();
   }

   static public function getRecordStudentAttendanceCount($student_id)
   {
       return StudentAttendanceModel::where('student_id', '=', $student_id)
       ->where('attendance_type', '!=', 3)
       ->count();
   }

    static public function getRecordStudentAbsentAttendanceCount($student_id)
    {
         return StudentAttendanceModel::where('student_id', '=', $student_id)
         ->where('attendance_type', '=', 3)
         ->count();
    }

}
