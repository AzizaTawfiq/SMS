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
}
