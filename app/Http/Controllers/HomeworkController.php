<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\School_Class;
use App\Models\AssignSubject;
use App\Models\HomeworkModel;
use App\Models\HomeworkSubmitModel;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Str;


class HomeworkController extends Controller
{
     public function homework_report()
    {
        $data['getRecord'] = HomeworkSubmitModel::getHomeworkReport();
        $data['header_title' ]= 'Homework Report';
        return view('admin.homework.report', $data);
    }
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
    public function ajaxGetSubject(Request $request)
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

    public function submittedHomework($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if (!empty($homework)) {
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
        $data['header_title' ]= 'Submitted Homework List';
        return view('admin.homework.submitted_list', $data);
        } else {
            abort(404);
        }
    }

    //teacher menu

    public function homeworkTeacher()
    {
        $class_ids = array();
        $getClass =  AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach($getClass as $class)
        {
            $class_ids[] = $class->class_id;
        }
        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);
        $data['header_title' ]= 'Homework List';
        return view('teacher.homework.list', $data);
    }
    public function addHomeworkTeacher()
    {
        $data['header_title' ]= 'Add homework';
        $data['getClass'] =  AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        return view('teacher.homework.add', $data);
    }

    public function insertHomeworkTeacher(Request $request)
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
        return redirect('teacher/homework')->with('success', 'Homework added successfully');

    }

    public function editHomeworkTeacher( $id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = AssignSubject::MySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title' ]= 'Edit homework';
        return view('teacher.homework.edit', $data);


    }

    public function updateHomeworkTeacher($id, Request $request)
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
        return redirect('teacher/homework')->with('success', 'Homework updated successfully');

    }

    public function deleteHomeworkTeacher($id)
    {
        $homework = HomeworkModel::getSingle($id);
        if (!empty($homework)) {
            $homework->is_deleted=1;
            $homework->save();
            return redirect('teacher/homework')->with('success', 'Homework deleted successfully');
        } else {
            abort(404);
        }
    }

    public function submittedHomeworkTeacher($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if (!empty($homework)) {
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
        $data['header_title' ]= 'Submitted Homework List';
        return view('teacher.homework.submitted_list', $data);
        } else {
            abort(404);
        }
    }

    //student menu

    public function myHomeworkStudent()
    {
        $data['getRecord'] = HomeworkModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title' ]= 'Homework List';
        return view('student.homework.list', $data);
    }

    public function submitHomework($homework_id)
    {
        $data['getRecord'] = HomeworkModel::getSingle($homework_id);
        $data['header_title' ]= 'Submit homework';
        return view('student.homework.submit', $data);
    }
    public function insertSubmitHomework($homework_id ,Request $request)
    {
        $homework = new HomeworkSubmitModel;
        $homework-> homework_id = $homework_id;
        $homework-> student_id = Auth::user()->id;
        $homework-> description = trim($request-> description);
        if (!empty($request->file('document_file'))) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/homework/', $filename);
            $homework->document_file = $filename;
        }
        $homework->save();
        return redirect('student/my_homework')->with('success', 'Homework submitted successfully');
    }

    public function mySubmittedHomework()
    {
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent(Auth::user()->id);
        $data['header_title' ]= 'Homework List';
        return view('student.homework.submitted_list', $data);
    }

    }
