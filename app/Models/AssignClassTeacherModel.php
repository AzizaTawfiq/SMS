<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Models\WeekModel;
use App\Models\ClassSubjectTimetableModel;

class AssignClassTeacherModel extends Model
{
    use HasFactory;
    protected $table = 'assign_class_teacher';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getAlreadyFirst($class_id, $teacher_id){
      return self::where('class_id', '=', $class_id)->where('teacher_id', '=', $teacher_id)->first();
    }
    static public function getAssignTeacherId( $class_id){
      return self::where('class_id', '=', $class_id)->where('is_deleted', '=', 0)->get();
    }

    static public function deleteTeacher( $class_id){
      return self::where('class_id', '=', $class_id)->delete();
    }

        static public function getMyClassSubjectCount($teacher_id){
        $return = AssignClassTeacherModel::select('assign_class_teacher.id')
        ->join('school_classes','school_classes.id','=','assign_class_teacher.class_id')
        ->join('subject_school_class','subject_school_class.schoolclass_id','=','school_classes.id')
        ->join('subjects','subjects.id','=','subject_school_class.subject_id')
        ->where('assign_class_teacher.is_deleted','=',0)
        ->where('assign_class_teacher.status','=',0)
        ->where('subjects.status','=',0)
        ->where('subjects.deleted_at','=',null)
        ->where('subject_school_class.status','=',0)
        ->where('subject_school_class.deleted_at','=',null)
        ->where('assign_class_teacher.teacher_id','=',$teacher_id)
        ->count();
        return $return;
    }

        static public function getMyClassSubjectGroupCount($teacher_id){
        $return = AssignClassTeacherModel::select('assign_class_teacher.id')
        ->join('school_classes','school_classes.id','=','assign_class_teacher.class_id')
        ->where('assign_class_teacher.is_deleted','=',0)
        ->where('assign_class_teacher.status','=',0)
        ->where('assign_class_teacher.teacher_id','=',$teacher_id)
        ->count();
        return $return;
    }

    static public function getMyClassSubject($teacher_id){
        $return = AssignClassTeacherModel::select('assign_class_teacher.*','school_classes.name as class_name','subjects.name as subject_name','subjects.type as subject_type','school_classes.id as class_id','subjects.id as subject_id',)
        ->join('school_classes','school_classes.id','=','assign_class_teacher.class_id')
        ->join('subject_school_class','subject_school_class.schoolclass_id','=','school_classes.id')
        ->join('subjects','subjects.id','=','subject_school_class.subject_id')
        ->where('assign_class_teacher.is_deleted','=',0)
        ->where('assign_class_teacher.status','=',0)
        ->where('subjects.status','=',0)
        ->where('subjects.deleted_at','=',null)
        ->where('subject_school_class.status','=',0)
        ->where('subject_school_class.deleted_at','=',null)
        ->where('assign_class_teacher.teacher_id','=',$teacher_id)
        ->get();
        return $return;
    }

    static public function getMyCalendarTeacher($teacher_id){
        $return = AssignClassTeacherModel::select('class_subject_timetable.*','school_classes.name as class_name',
        'subjects.name as subject_name','week.name as week_name' ,'week.fullcalendar_day')
        ->join('school_classes','school_classes.id','=','assign_class_teacher.class_id')
        ->join('subject_school_class','subject_school_class.schoolclass_id','=','school_classes.id')
        ->join('class_subject_timetable','class_subject_timetable.subject_id','=','subject_school_class.subject_id')
        ->join('subjects','subjects.id','=','class_subject_timetable.subject_id')
        ->join('week','week.id','=','class_subject_timetable.week_id')
        ->where('assign_class_teacher.teacher_id','=',$teacher_id)
        ->where('assign_class_teacher.is_deleted','=',0)
        ->where('assign_class_teacher.status','=',0)
        ->get();
        return $return;
    }
    static public function getMyClassSubjectGroup($teacher_id){
        $return = AssignClassTeacherModel::select('assign_class_teacher.*','school_classes.name as class_name', 'school_classes.id as class_id')
        ->join('school_classes','school_classes.id','=','assign_class_teacher.class_id')
        ->where('assign_class_teacher.is_deleted','=',0)
        ->where('assign_class_teacher.status','=',0)
        ->where('assign_class_teacher.teacher_id','=',$teacher_id)
        ->groupBy('assign_class_teacher.class_id')
        ->get();
        return $return;
    }

    static public function getRecord(){
        $return = self::select('assign_class_teacher.*','school_classes.name as class_name',
            \DB::raw("CONCAT(teacher.name, ' ', teacher.last_name) as teacher_name"),
            \DB::raw("CONCAT(users.name, ' ', users.last_name) as created_by_name"))
        ->join('users as teacher','teacher.id','=','assign_class_teacher.teacher_id')
        ->join('school_classes','school_classes.id','=','assign_class_teacher.class_id')
        ->join('users','users.id','=','assign_class_teacher.created_by')
        ->where('assign_class_teacher.is_deleted','=',0);
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('school_classes.name', 'like', '%' . Request::get('class_name'). '%');
        }
        if (!empty(Request::get('teacher_name'))) {
            $return = $return->where(\DB::raw("CONCAT(teacher.name, ' ', teacher.last_name)"), 'like', '%' . Request::get('teacher_name'). '%');
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status')) == 100 ? 0 : 1;
            $return = $return->where('assign_class_teacher.status', '=', $status);
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('assign_class_teacher.created_at', '=', Request::get('date'));
        }
        $return = $return->orderBy('assign_class_teacher.id','desc')
        ->paginate(10);
        return $return;
    }

    static public function getMyTimetable($class_id, $subject_id){
        $getWeek = WeekModel::getWeekByName(date('l'));
        if (!$getWeek) {
            return null;
        }

        $return =  ClassSubjectTimetableModel::getRecordClassSubject($class_id, $subject_id, $getWeek->id);
    }
}


