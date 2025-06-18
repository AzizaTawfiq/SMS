<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School_Class;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Str;
use App\Exports\ExportStudent;
use Maatwebsite\Excel\Facades\Excel;



class StudentController extends Controller
{

    public function exportStudentExcel(Request $request)
    {
       return Excel::download(new ExportStudent, 'students list'.date('d-m-Y').'.xlsx');
    }
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title' ]= 'Students List';
        return view('admin.student.list', $data);
    }
    public function add()
    {

        $data['school_classes'] = School_Class::get();
        $data['header_title' ]= 'Add student';
        return view('admin.student.add', $data);
    }
    public function insert(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'admission_number' => 'max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'gender' => 'required',
            'mobile_number' => 'max:15|min:8',
            'address' => 'required',
            'class_id' => 'required',
            'height' => 'max:10',
            'weight' => 'max:10',
            'blood_group' => ' max:10',
            'religion' => 'max:50',
            'caste' => 'max:50',
        'status' => 'required',
        'admission_date' => 'required',
        'roll_number' => 'max:50',

        ]);

        $student= new User;

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
            }
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = trim($request->date_of_birth);
        }
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date))
        {
            $student->admission_date = trim($request->admission_date);
        }
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->role = 3;
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student added successfully');

    }

    public function edit( $id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title' ]= 'Edit student';
            return view('admin.student.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'admission_number' => 'max:50',
            'email' => 'required|email|unique:users,email'.$id,
            'password' => 'min:6',
            'gender' => 'required',
            'mobile_number' => 'max:15|min:8',
            'address' => 'required',
            'class_id' => 'required',
            'height' => 'max:10',
            'weight' => 'max:10',
            'blood_group' => ' max:10',
            'religion' => 'max:50',
            'caste' => 'max:50',
        'status' => 'required',
        'admission_date' => 'required',
        'roll_number' => 'required|max:50',

        ]);

        $student= User::getSingle($id);

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
            }
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = trim($request->date_of_birth);
        }
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date))
        {
            $student->admission_date = trim($request->admission_date);
        }
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password))
        {
            $student->password = Hash::make($request->password);
        }
        $student->role = 3;
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student updated successfully');

    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        if (!empty($user)) {
            $user->is_deleted=1;
            $user->save();
            return redirect()->back()->with('success', 'Student deleted successfully');
        } else {
            abort(404);
        }
    }

    //teacher side
    public function myStudents()
    {
        $data['getRecord'] = User::getTeacherStudents(Auth::user()->id);
        return view('teacher.my_students', $data);

    }
}
