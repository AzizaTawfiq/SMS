<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController extends Controller
{

    public function login()
    {
        /* dd(Hash::make('P@ssw0rd')); */
        if(!empty(Auth::check())){
            if(Auth::user()->role == 1){
                return redirect('admin/dashboard');
            }elseif(Auth::user()->role == 2){
                return redirect('teacher/dashboard');
            }elseif(Auth::user()->role == 3){
                return redirect('student/dashboard');
            }elseif(Auth::user()->role == 4){
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }
    public function AuthLogin(Request $request)
    {

        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            if(Auth::user()->role == 1){
                return redirect('admin/dashboard');
            }elseif(Auth::user()->role == 2){
                return redirect('teacher/dashboard');
            }elseif(Auth::user()->role == 3){
                return redirect('student/dashboard');
            }elseif(Auth::user()->role == 4){
                return redirect('parent/dashboard');
            }
        }else{
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
