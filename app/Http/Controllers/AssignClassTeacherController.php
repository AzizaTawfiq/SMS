<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\School_Class;
use App\Models\AssignSubject;
use App\Models\WeekModel;
use App\Models\AssignClassTeacherModel;
use App\Models\ClassSubjectTimetableModel;
use Illuminate\Support\Facades\Auth;


class AssignClassTeacherController extends Controller
{
    public function list()
    {
         $data['getRecord'] = AssignClassTeacherModel::getRecord();


        return view('admin.assign_class_teacher.list', $data);
    }
    public function add()
    {
        $data['getClass'] = School_Class::get();
        $data['getTeacher'] = User::getTeacherClass();
        return view('admin.assign_class_teacher.add', $data);
    }

    public function insert(Request $request)
    {
       if(!empty($request->teacher_id)){
        foreach($request->teacher_id as $teacher_id){
          $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
          if(!empty($getAlreadyFirst)){
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
          } else {
            $save = new AssignClassTeacherModel;
            $save->class_id = $request->class_id;
            $save->teacher_id = $teacher_id;
            $save->status = $request->status;
            $save->created_by = Auth::user()->id;
            $save->save();
          }
        }
        return redirect('admin/assign_class_teacher/list')->with('success', 'Class assigned to teacher successfully');
       }
       else {
           return redirect()->back()->with('error', 'Something went wrong,try again');
       }

    }

    public function edit( $id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord' ]= $getRecord;
            $data['getAssignTeacherId' ]= AssignClassTeacherModel::getAssignTeacherId($getRecord->class_id);
            $data['getClass'] = School_Class::get();
            $data['getTeacher'] = User::getTeacherClass();
            return view('admin.assign_class_teacher.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        AssignClassTeacherModel::deleteTeacher($request->class_id);
        if(!empty($request->teacher_id)){
            foreach($request->teacher_id as $teacher_id){
              $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
              if(!empty($getAlreadyFirst)){
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
              } else {
                $save = new AssignClassTeacherModel;
                $save->class_id = $request->class_id;
                $save->teacher_id = $teacher_id;
                $save->status = $request->status;
                $save->created_by = Auth::user()->id;
                $save->save();
              }
            }
        }
        return redirect('admin/assign_class_teacher/list')->with('success', 'Assign class to teacher updated successfully');
    }

    public function edit_single( $id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord' ]= $getRecord;
            $data['getClass'] = School_Class::get();
            $data['getTeacher'] = User::getTeacherClass();
            return view('admin.assign_class_teacher.edit_single', $data);
        } else {
            abort(404);
        }

    }

    public function update_single($id, Request $request)
    {
        $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $request->teacher_id);
        if(!empty($getAlreadyFirst)){
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
          } else {
            $save = AssignClassTeacherModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->teacher_id = $request->teacher_id;
            $save->status = $request->status;
            $save->save();
          }
        return redirect('admin/assign_class_teacher/list')->with('success', 'Assign class to teacher updated successfully');
    }

    public function delete($id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        $getRecord->delete();
        return redirect()->back()->with('success', 'Assign class to teacher deleted successfully');

    }

    // teacher side
    public function myClassSubject()
    {
        $data['getRecord'] = AssignClassTeacherModel::getMyClassSubject(Auth::user()->id);
        return view('teacher.my_class_subject', $data);

    }
}
