<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ParentController extends Controller
{
    public function list()
    {
        $data = User::where('role',4)
        ->where('is_deleted',0)
        ->get();
        return view('admin.parent.list', compact('data'));
    }

    public function search(Request $request){
   
      $query = User::query();

    if ($request->filled('first_name')) {
        $query->where('name', 'like', '%' . $request->first_name . '%');
    }

    if ($request->filled('last_name')) {
        $query->where('name', 'like', '%' . $request->last_name . '%');
    }

    if ($request->filled('email')) {
        $query->where('email',$request->email);
    }

    if ($request->filled('gender')) {
        $query->where('gender',$request->gender);
    }

    if ($request->filled('occupation')) {
        $query->where('occupation',$request->occupation);
    }

    if ($request->filled('address')) {
        $query->where('address',$request->address);
    }

    if ($request->filled('mobile')) {
        $query->where('mobile_number',$request->mobile);
    }

    if ($request->filled('status')) {
        $query->where('status',$request->status);
    }

     if ($request->filled('created_at')) {
        $query->whereDate('created_at',$request->created_at);
    }




        $data = $query->where('role',4)->get();
 
       return view('admin.parent.list', compact('data'));
    }

    public function add()
    {
        $data['header_title'] = 'Add parent';
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

        $Parent = new User;
        $Parent->name = trim($request->name) . " " . trim($request->last_name);
        $Parent->gender = trim($request->gender);
        $Parent->occupation = trim($request->occupation);
        $Parent->address = trim($request->address);

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
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

    public function edit($id)
    {


        $data = DB::table('users')->where('id', $id)
            ->select(
                '*',
                DB::raw("SUBSTRING_INDEX(name, ' ', 1) as first_name"),
                DB::raw("SUBSTRING_INDEX(name, ' ', -1) as last_name")
            )
            ->first();


        return view('admin.Parent.edit', [
            'data' => $data
        ]);
    }

    public function update($id, Request $request)
    {
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
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->occupation = $request->occupation;
        $user->mobile_number = $request->mobile_number;
        $user->gender = $request->gender;
        $user->status = $request->status;
      

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

      
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

        return redirect('admin/parent/list')->with('success', 'Parent updated successfully');

       
    }

    public function delete($id)
    {

            $user = User::findOrfail($id);
            $user->is_deleted = 1;
            $user->save();
            return redirect()->back()->with('success', 'Parent deleted successfully');
      
    }

    public function MyStudent($id)
    {

        $data['parent_id'] = $id;
        $data['getSearchstudent'] = User::getSearchstudent();
        $data['getRecored'] = User::getMystudent($id);
        $data['header_title'] = 'parent student List';
        return view('admin.parent./my_student', $data);
    }
}
