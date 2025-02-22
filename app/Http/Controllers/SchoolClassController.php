<?php

namespace App\Http\Controllers;

use App\Models\School_Class;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    public function list()
    {
        $school_classes = School_Class::all();
        return view('admin.school_classes.list',compact('school_classes'));
    }

    public function add()
    {
        return view('admin.school_classes.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:school_classes|max:255',
            'status' => 'required|in:0,1',
        ], [
            'status.required' => 'Please select a status.',
            'status.in' => 'The selected status is invalid.',
        ]);

        $school_class = new School_Class();
        $school_class->name = $request->name;
        $school_class->status = $request->status;
        $school_class->created_by = Auth::user()->id;
        $school_class->save();
        return redirect()->route('school_classes.list')->with('success','class inserted successfuly');
    }
}
