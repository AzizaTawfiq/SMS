<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function myAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = 'My Account';
        if (Auth::user()->role == 1) {
            return view('admin.my-account',$data);
        }  else if (Auth::user()->role == 2) {
            return view('teacher.my-account',$data);
        } else if (Auth::user()->role == 3) {
            return view('student.my-account',$data);
        } else if (Auth::user()->role == 4){
            return view('parent.my_account',$data);

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
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'max:255',
            'occupation' => 'max:255',
            'mobile_number' => 'max:15|min:8',

        ]);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->occupation = $request->occupation;
        $user->mobile_number = $request->mobile_number;
        $user->gender = $request->gender;


        if ($request->hasFile('image')) {
            $imagePath = public_path('upload/profile/' . $user->profile_pic);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->file('image');

            $imageName = time() . '.' . $request->image->extension();
            $destinationPath = public_path('upload/profile');
            $image->move($destinationPath, $imageName);
            $user->profile_pic = $imageName;
        }

        $user->save();

        return redirect('parent/account')->with('success', 'Account updated successfully');    
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
