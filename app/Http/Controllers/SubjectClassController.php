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

        $school_classes = School_Class::with('subjects')->get();
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
        $user_id = auth()->id();
        $check = AssignSubject::where('schoolclass_id', $request->school_class)
            ->where('subject_id', $request->subjects)->first();
        if (!empty($check)) {
            return redirect()->back()->with('success', 'subject assign previous');
        }
        $school_class->subjects()->attach($request->subjects, ['status' => $request->status, 'user_id' => $user_id, 'created_at' => now(), 'updated_at' => now()]);
        return redirect()->route('assign_subjects.list')->with('success', 'subject assign seccessfuly');
    }

    public function get_assignsubjects()
    {
        $school_classes = School_Class::with('subjects')->get();
        return view('admin.assign_subject.list', compact('school_classes'));
    }

    public function destroy($class_id, $subject_id)
    {

        $check = AssignSubject::where('schoolclass_id', $class_id)
            ->where('subject_id', $subject_id)->first();
        $check->delete();
        // $school_class = School_Class::findOrFail($request->school_class);
        // $user_id = auth()->id();
        // $school_class->subjects()->detach($request->subjects);
        return redirect()->route('assign_subjects.list')->with('success', 'subject assign deleted seccessfuly');
    }
}
