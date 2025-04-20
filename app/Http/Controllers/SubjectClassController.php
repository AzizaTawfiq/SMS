<?php

namespace App\Http\Controllers;

use App\Models\School_Class;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectClassController extends Controller
{
    public function list(){
        $school_classes = School_Class::get();
        $subjects = Subject::get();
        return view('admin.assign_subject.list', compact('school_classes','subjects'));
    }

    public function add(){
        $school_classes = School_Class::get();
        $subjects = Subject::get();
        return view('admin.assign_subject.add', compact('school_classes','subjects'));
    }
}
