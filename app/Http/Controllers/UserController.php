<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SettingsModel;
use Illuminate\Support\Facades\Hash;
use Str;
use Auth;


class UserController extends Controller
{
    public function settings()
    {
        $data['header_title'] = 'Settings';
        $data['getRecord'] = SettingsModel::getSingle();
        return view('admin.settings',$data);
    }
    public function updateSettings(Request $request)
    {
        $settings = SettingsModel::getSingle();
        $settings->paypal_email = $request->paypal_email;
        $settings->save();
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
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
        } else if (Auth::user()->role == 4){
            return view('parent.account',$data);

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
        return redirect('admin/account')->with('success', 'Account updated successfully');
     }

     public function updateMyParentAccount(Request $request)
     {
        dd($request->all());
     }

        public function change_password()
        {
            $data['header_title'] = 'Change Password';
            return view('Profile.change_password', $data);
        }
        public function update_change_password(Request $request)
        {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:6|confirmed', ]);
                $user = User::find(Auth::id());
                if (Hash::check($request->old_password, $user->password))
                 {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return redirect()->back()->with('success', 'Password updated successfully!');
                }
                 else { return redirect()->back()->with('error', 'Old password is not correct!'); }
        }
}
