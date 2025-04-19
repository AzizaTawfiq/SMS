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
        $school_classes = School_Class::with('user')->paginate(10);
        return view('admin.school_classes.list', compact('school_classes'));
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
        $school_class->user_id = Auth::user()->id;
        $school_class->save();
        return redirect()->route('school_classes.list')->with('success', 'class inserted successfuly');
    }

    public function edit(Request $request)
    {
        $school_class = School_Class::findOrFail($request->id);
        
    }

    public function update(Request $request,$id)
    {
        $school_class = School_Class::findOrFail($id);
        $school_class->update($request->all());
        return redirect()->route('school_classes.list')->with('success', 'class updated successfuly');

    }

    public function destroy(Request $request)
    {
        $school_class = School_Class::findOrFail($request->id);
        $school_class->delete();
        return redirect()->route('school_classes.list')->with('success', 'class deleted successfuly');

    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        if(empty($search)){
            $search = $request->input('search_date');   
        }
       

        $school_classes = School_Class::when($search, function ($query, $search) {
        if($search=='Active'){$search=0;}
        if($search=='InActive'){$search=1;}
        
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('status', 'like', $search)
                         ->orWhereDate('created_at', $search);
        })->paginate(10);

        return view('admin.school_classes.list', compact('school_classes','search'));

    }


}
