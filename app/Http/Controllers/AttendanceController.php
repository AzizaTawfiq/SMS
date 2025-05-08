<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School_Class;
use App\Models\getStudentClass;
use App\Models\StudentAttendanceModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Str;


class AttendanceController extends Controller
{
    public function AttendanceStudent(Request $request)
    {
        $data['getClass'] = School_Class::get();

        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date'))){
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        return view('admin.attendance.student', $data);
    }

    public function submitAttendanceStudent(Request $request)
    {

        $check_attendance = StudentAttendanceModel::checkAlreadyAttendance($request->student_id,$request->class_id, $request->attendance_date);
       if(!empty($check_attendance)){
        $attendance = $check_attendance;
       } else {
           $attendance = new StudentAttendanceModel;
           $attendance->class_id = $request->class_id;
           $attendance->attendance_date = $request->attendance_date;
           $attendance->student_id = $request->student_id;
           $attendance->created_by = Auth::user()->id;
        }
        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();
        $json['message'] = 'Attendance saved successfully';
        echo json_encode($json);
    }

}
