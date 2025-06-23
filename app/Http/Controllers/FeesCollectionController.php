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
        $getStudentClass= User::getSingleClass($student_id);
        $paid_amount= FeesStudentModel::getPaidAmount($student_id,$getStudentClass->class_id);
        $remaining_amount = $getStudentClass->amount - $paid_amount;
        if($remaining_amount >= $request->amount){

            if($remaining_amount >= $request->amount){
                $remaining_amount_user =  $remaining_amount - $request->amount;
                $payment = new FeesStudentModel;
                $payment->student_id = $student_id;
                $payment->class_id = $getStudentClass->class_id;
                $payment->paid_amount = trim($request->amount);
                $payment->total_amount = $remaining_amount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = trim($request->payment_type);
                $payment->remark = trim($request->remark);
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 1;
                $payment->save();
                return redirect()->back()->with('success', 'Fees added successfully');
            } else {
                return redirect()->back()->with('error', 'Fees added failed as amount is greater than remaining amount');
            }
        } else {
            return redirect()->back()->with('error', 'You must add at least 1$');
        }


    }

    //student menu
    public function collectFeesStudent(Request $request)
    {
        $student_id = Auth::user()->id;
        $class_id = Auth::user()->class_id;
        $getStudentClass= User::getSingleClass($student_id);
        $data['getStudentClass' ]= $getStudentClass;
        $data['getFees' ]= FeesStudentModel::getFees($student_id);
        $data['paid_amount' ]= FeesStudentModel::getPaidAmount($student_id,$class_id);
        $data['header_title' ]= 'Add fees';
        return view('student.my_fees_collection', $data);
    }
    public function collectFeesStudentPayment(Request $request)
    {
        $student_id = Auth::user()->id;
        $class_id = Auth::user()->class_id;
        $getStudentClass= User::getSingleClass($student_id);
        $paid_amount= FeesStudentModel::getPaidAmount($student_id,$class_id);
        if(!empty($request->amount)){
            $remaining_amount = $getStudentClass->amount - $paid_amount;
            if($remaining_amount >= $request->amount){
                $remaining_amount_user =  $remaining_amount - $request->amount;
                $payment = new FeesStudentModel;
                $payment->student_id = $student_id;
                $payment->class_id = $class_id;
                $payment->paid_amount = trim($request->amount);
                $payment->total_amount = $remaining_amount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = trim($request->payment_type);
                $payment->remark = trim($request->remark);
                $payment->created_by = $student_id;
                $payment->save();
                if($request->payment_type == 'paypal')
                {

                } else if($request->payment_type == 'stripe'){

                }
                return redirect()->back()->with('success', 'Fees added successfully');

            }
            else {
                return redirect()->back()->with('error', 'Fees added failed as amount is greater than remaining amount');
            }
        }
        else {
            return redirect()->back()->with('error', 'You must add at least 1$');
        }
    }

}
