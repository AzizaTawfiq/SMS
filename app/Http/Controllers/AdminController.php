<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;


class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title' ]= 'Admins List';
        return view('admin.admin.list', $data);
    }
    public function add()
    {
        $data['header_title' ]= 'Add admin';
        return view('admin.admin.add', $data);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'

        ]);
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->role = 1;
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $user->profile_pic = $filename;
            }
        $user->save();
        return redirect('admin/admin/list')->with('success', 'Admin added successfully');

    }

    public function edit( $id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title' ]= 'Edit admin';
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }

    }

   public function update($id, Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = User::findOrFail($id); 
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->hasFile('profile_pic')) {
        
        if ($user->profile_pic) {
            $oldImagePath = public_path('upload/profile/' . $user->profile_pic);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $file = $request->file('profile_pic');
        $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload/profile'), $filename);
        $user->profile_pic = $filename;
    }

    $user->save();
    return redirect('admin/admin/list')->with('success', 'Admin edite successfully');
}

    public function delete($id)
    {
        $user = User::getSingle($id);
        if (!empty($user)) {
            $user->is_deleted=1;
            $user->save();
            return redirect('admin/admin/list')->with('success', 'Admin deleted successfully');
        } else {
            abort(404);
        }
    }
}
