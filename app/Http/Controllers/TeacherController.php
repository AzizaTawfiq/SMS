<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;


class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title' ]= 'Teachers List';
        return view('admin.teacher.list', $data);
    }
    public function add()
    {


        $data['header_title' ]= 'Add teacher';
        return view('admin.teacher.add', $data);
    }
    public function insert(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'max:15|min:8',
            'marital_status' => ' max:50',

        ]);

        $teacher= new User;

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $teacher->profile_pic = $filename;
            }
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->admission_date))
        {
            $teacher->admission_date = trim($request->admission_date);
        }
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->address = trim($request->address);
        $teacher->qualification = trim($request->qualification);
        $teacher->experience = trim($request->experience);
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->role = 2;
        $teacher->save();
        return redirect('admin/teacher/list')->with('success', 'Teacher added successfully');

    }

    public function edit( $id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title' ]= 'Edit teacher';
            return view('admin.teacher.edit', $data);
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

        $teacher= User::getSingle($id);

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $teacher->profile_pic = $filename;
            }
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->admission_number = trim($request->admission_number);
        $teacher->roll_number = trim($request->roll_number);
        $teacher->class_id = trim($request->class_id);
        $teacher->gender = trim($request->gender);
        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        $teacher->caste = trim($request->caste);
        $teacher->religion = trim($request->religion);
        $teacher->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date))
        {
            $teacher->admission_date = trim($request->admission_date);
        }
        $teacher->blood_group = trim($request->blood_group);
        $teacher->height = trim($request->height);
        $teacher->weight = trim($request->weight);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        if(!empty($request->password))
        {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->role = 3;
        $teacher->save();
        return redirect('admin/teacher/list')->with('success', 'Teacher updated successfully');

    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        if (!empty($user)) {
            $user->is_deleted=1;
            $user->save();
            return redirect()->back()->with('success', 'Teacher deleted successfully');
        } else {
            abort(404);
        }
    }
}
