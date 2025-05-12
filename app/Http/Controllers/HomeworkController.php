<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Auth;  
use App\Models\School_Class;
use App\Models\AssignSubject;
use App\Models\HomeworkModel;
use Illuminate\Support\Str;


class HomeworkController extends Controller
{
    public function homework()
    {
        $data['getRecord'] = HomeworkModel::getRecord();
        $data['header_title' ]= 'Homework List';
        return view('admin.homework.list', $data);
    }
    public function add()
    {

        $data['header_title' ]= 'Add homework';
        $data['getClass'] = School_Class::get();
      
        return view('admin.homework.add', $data);
    }
    public function ajax_get_subject(Request $request)
    {

        $class_id = $request->class_id;
        $getSubject = AssignSubject::MySubject($class_id);
        $html="<option value=''>Select subject</option>";
        foreach($getSubject as $value){
             $html .= "<option value='" .$value->subject_id . "'>$value->subject_name</option>";
         }
 
         $json['message']= $html;
         echo json_encode($json);

        }

      
    public function insert(Request $request)
    {
     
        $request->validate([
            'class_id' =>'required',
            'subject_id' =>'required',
            'homework_date' =>'required',
            'submission_date' =>'required',
            'description' =>'required'
        ]);
        $homework = new HomeworkModel;
        $homework-> class_id= trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        if(!empty($request->homework_date))
        {
            $homework->homework_date = trim($request->homework_date);
        }
        if(!empty($request->submission_date))
        {
            $homework->submission_date = trim($request->submission_date);
        }
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;
        if (!empty($request->file('document_file'))) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/homework/', $filename);
            $homework->document_file = $filename;
        }
        $homework->save();
        return redirect('admin/homework')->with('success', 'Homework added successfully');

    }

    public function edit( $id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = AssignSubject::MySubject($getRecord->class_id);
        $data['getClass'] = School_Class::get();
        $data['header_title' ]= 'Edit homework'; 
        return view('admin.homework.edit', $data);
       

    }

    public function update($id, Request $request)
    {
        $request->validate([
            'class_id' =>'required',
            'subject_id' =>'required',
            'homework_date' =>'required',
            'submission_date' =>'required',
            'description' =>'required'
        ]);
        $homework= HomeworkModel::getSingle($id);
        $homework-> class_id= trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        if(!empty($request->homework_date))
        {
            $homework->homework_date = trim($request->homework_date);
        }
        if(!empty($request->submission_date))
        {
            $homework->submission_date = trim($request->submission_date);
        }
        $homework->description = trim($request->description);
        if (!empty($request->file('document_file'))) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/homework/', $filename);
            $homework->document_file = $filename;
        }
        $homework->save();
        return redirect('admin/homework')->with('success', 'Homework updated successfully');

    }

    public function delete($id)
    {
        $homework = HomeworkModel::getSingle($id);
        if (!empty($homework)) {
            $homework->is_deleted=1;
            $homework->save();
            return redirect('admin/homework')->with('success', 'Homework deleted successfully');
        } else {
            abort(404);
        }
    }
}
