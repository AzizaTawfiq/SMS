<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;
use Auth;


class UserController extends Controller
{
    public function myAccount()
    {
        $data['getRecord'] = Auth::user();
        $data['header_title'] = 'My Account';
        if (Auth::user()->role == 1) {
            return view('admin.my-account',$data);
        }  else if (Auth::user()->role == 2) {
            return view('teacher.my-account',$data);
        } else if (Auth::user()->role == 3) {
            return view('student.my-account',$data);
        } else{
            return view('parent.my-account',$data);

        }

    }
     public function updateMyAdminAccount(Request $request)
     {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$admin->id,
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();
        return redirect('admin/account')->with('success', 'Account updated successfully');     }
}
