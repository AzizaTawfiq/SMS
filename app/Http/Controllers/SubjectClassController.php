<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;
use App\Models\School_Class;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectClassController extends Controller
{
    public function list()
    {
        $school_classes = School_Class::get();
        $subjects = Subject::get();
        return view('admin.assign_subject.list', compact('school_classes', 'subjects'));
    }

    public function add()
    {
        $school_classes = School_Class::get();
        $subjects = Subject::get();
        return view('admin.assign_subject.add', compact('school_classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $school_class = School_Class::findOrFail($request->school_class);
        $school_class->subjects()->attach($request->subjects, ['status' => $request->status, 'user_id' => Auth::user()->id, 'created_at' => now(), 'updated_at' => now()]);
    }

    public function get_assignsubjects()
    {
        $school_classes = School_Class::with('subjects')->get();
        return view('admin.assign_subject.list',compact('school_classes'));
      
    }
}
