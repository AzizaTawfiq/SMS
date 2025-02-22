<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;


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
            'password' => 'required|min:6'
        ]);
        $user=  User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/admin/list')->with('success', 'Admin updated successfully');

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
