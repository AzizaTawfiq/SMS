<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ExamModel;
use App\Models\School_Class;
use App\Models\Subject;
use App\Models\AssignClassTeacherModel;
use App\Models\NoticeBoardModel;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title' ]= 'Dashboard';
        if(!empty(Auth::check()))
        {
            if(Auth::user()->role == 1){
                $data['TotalAdmin'] = User::getTotalUser(1);
                $data['TotalTeachers'] = User::getTotalUser(2);
                $data['TotalStudents'] = User::getTotalUser(3);
                $data['TotalParents'] = User::getTotalUser(4);

                $data['TotalExam']= ExamModel::getTotalExam();
                $data['TotalClass']=School_Class::getTotalClass();
                $data['TotalSubject']=Subject::getTotalSubject();
                return view('admin.dashboard', $data);
            }
            elseif(Auth::user()->role == 2)
            {
                 $data['TotalStudents'] = User::getTeacherStudentsCount(Auth::user()->id);
                 $data['TotalClass']=AssignClassTeacherModel::getMyClassSubjectGroupCount(Auth::user()->id);
                 $data['TotalSubject']=AssignClassTeacherModel::getMyClassSubjectCount(Auth::user()->id);
                 $data['totalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::getUser()->role);
                return view('teacher.dashboard', $data);
            }
            elseif(Auth::user()->role == 3)
            {
                return view('student.dashboard', $data);
            }
            elseif(Auth::user()->role == 4){
                return view('parent.dashboard', $data);
            }
        }
    }
}
