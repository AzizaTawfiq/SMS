<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\School_Class;
use App\Models\FeesStudentModel;
use Illuminate\Support\Facades\Auth;


class FeesCollectionController extends Controller
{
    public function collectFees(Request $request)
    {
        $data['getClass'] = School_Class::get();
        $data['getRecord'] = User::getStudentCollectFees($request->class_id);
        $data['header_title' ]= 'Collect fees';
        return view('admin.fees_collection.collect_fees', $data);
    }

    public function addFees($student_id)
    {
        $getStudentClass= User::getSingleClass($student_id);
        $data['getStudentClass' ]= $getStudentClass;
        $data['getFees' ]= FeesStudentModel::getFees($student_id);
        $data['paid_amount' ]= FeesStudentModel::getPaidAmount($student_id,$getStudentClass->class_id);
        $data['header_title' ]= 'Add fees';
        return view('admin.fees_collection.add_fees', $data);
    }

    public function insertFees($student_id , Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'payment_type' => 'required',
        ]);
        $paid_amount= FeesStudentModel::getPaidAmount($student_id,$getStudentClass->class_id);
        $remaining_amount = $getStudentClass->amount - $paid_amount;
        if($remaining_amount >= $request->amount){
            $getStudentClass= User::getSingleClass($student_id);
            $payment = new FeesStudentModel;
            $payment->student_id = $student_id;
            $payment->class_id = $getStudentClass->class_id;
            $payment->paid_amount = trim($request->amount);
            $payment->payment_type = trim($request->payment_type);
            $payment->remark = trim($request->remark);
            $payment->created_by = Auth::user()->id;
            $payment->save();
            return redirect()->back()->with('success', 'Fees added successfully');
        } else {
            return redirect()->back()->with('error', 'Fees added failed as amount is greater than remaining amount ');
        }


    }
















    public function edit( $id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title' ]= 'Edit admin';
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            /* 'password' => 'required|min:6' */
        ]);
        $user=  User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
      /*   if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        } */
        $user->save();
        return redirect('admin/admin/list')->with('success', 'Admin updated successfully');

    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        if (!empty($user)) {
            $user->is_deleted=1;
            $user->save();
            return redirect('admin/admin/list')->with('success', 'Admin deleted successfully');
        } else {
            abort(404);
        }
    }
}
