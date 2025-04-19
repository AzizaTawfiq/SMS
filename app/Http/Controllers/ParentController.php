<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;

class ParentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getParent();
        $data['header_title'] = 'Parent List';
        return view('admin.parent.list', $data);
    }

    public function add()
    {
        $data['header_title' ]= 'Add parent';
        return view('admin.Parent.add', $data);
    }

    public function insert(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'max:15|min:8',
            'address' => 'max:255',
            'occupation' => 'max:255'
        ]);

        $Parent= new User;
        $Parent->name = trim($request->name);
        $Parent->last_name = trim($request->last_name);
        $Parent->gender = trim($request->gender);
        $Parent->occupation = trim($request->occupation);
        $Parent->address = trim($request->address);

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $Parent->profile_pic = $filename;
            }
        
        $Parent->mobile_number = trim($request->mobile_number);
        $Parent->status = trim($request->status);
        $Parent->email = trim($request->email);
        $Parent->password = Hash::make($request->password);
        $Parent->role = 4;
        $Parent->save();
        return redirect('admin/parent/list')->with('success', 'New Parent added successfully');

    }

    public function edit( $id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title' ]= 'Edit Parent';
            return view('admin.Parent.edit', $data);
        } else {
            abort(404);
        }

    }   

    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'max:15|min:8',
            'address' => 'max:255',
            'occupation' => 'max:255'

        ]);

        $Parent= User::getSingle($id);
        $Parent->name = trim($request->name);
        $Parent->last_name = trim($request->last_name);
        $Parent->gender = trim($request->gender);
        $Parent->occupation = trim($request->occupation);
        $Parent->address = trim($request->address);


        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $Parent->profile_pic = $filename;
            }
       
     
        $Parent->mobile_number = trim($request->mobile_number);
        $Parent->status = trim($request->status);
        $Parent->email = trim($request->email);
        if(!empty($request->password))
        {
            $Parent->password = Hash::make($request->password);
        }
        $Parent->role = 4;
        $Parent->save();
        return redirect('admin/Parent/list')->with('success', 'Parent updated successfully');

    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        if (!empty($user)) {
            $user->is_deleted=1;
            $user->save();
            return redirect()->back()->with('success', 'Parent deleted successfully');
        } else {
            abort(404);
        }
    }

    public function MyStudent($id) {

        $data['parent_id'] = $id;
        $data['getSearchstudent'] = User::getSearchstudent();
        $data['getRecored'] = User::getMystudent($id);
        $data['header_title'] = 'parent student List';
        return view('admin.parent./my_student', $data);

    }

   



  
   
}
