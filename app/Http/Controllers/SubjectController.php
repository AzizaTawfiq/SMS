<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list(){
        $subjects = Subject::with('user')->paginate(10);
        return view('admin.subjects.list', compact('subjects'));
    }

    public function add(){
        return view('admin.Subjects.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:subjects|max:255',
            'type' => 'required|in:0,1',
            'status' => 'required|in:0,1',
        ],[
            'type.required' => 'Please select a type.',
            'type.in' => 'The selected type is invalid.',
        ],
         [
            'status.required' => 'Please select a status.',
            'status.in' => 'The selected status is invalid.',
        ]);

        $subjest = new Subject();
        $subjest->name = $request->name;
        $subjest->type = $request->type;
        $subjest->status = $request->status;
        $subjest->user_id = Auth::user()->id;
        $subjest->save();
        return redirect()->route('subjects.list')->with('success', 'subject inserted successfuly');
    }

    public function edit(Request $request)
    {
        $subject = Subject::findOrFail($request->id);
        
    }

    public function update(Request $request,$id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        return redirect()->route('subjects.list')->with('success', 'subject updated successfuly');

    }

    public function destroy(Request $request)
    {
        $subject = Subject::findOrFail($request->id);
        $subject->delete();
        return redirect()->route('subjects.list')->with('success', 'subject deleted successfuly');

    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        if(empty($search)){
            $search = $request->input('search_date');   
        }
       

        $subjects = Subject::when($search, function ($query, $search) {
        if($search=='Theory'){$search=0;}
        elseif($search=='Practical'){$search=1;}

        elseif($search=='Active'){$search=0;}
        elseif($search=='InActive'){$search=1;}
        
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('type', 'like', $search)
                         ->orWhere('status', 'like', $search)
                         ->orWhereDate('created_at', $search);
        })->paginate(10);

        return view('admin.subjects.list', compact('subjects','search'));

    }
}
