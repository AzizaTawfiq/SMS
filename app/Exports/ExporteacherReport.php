<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExporteacherReport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {     
        return [
            'Teacher ID',
            'Name',
            'Email',
            'Gender',
            'Date of Birth',
            'Mobile Number',
            'Joining Date',
            'Marital Status',
            'Address',
            'Status',
            'Admission Date',
            'Created At',
        ];
    }

    public function map($teacher): array
    {
        $teacher_name = $teacher->name . ' ' . $teacher->last_name;

        $mobile_number = '';
        if(!empty($teacher->mobile_number))
        {
            $mobile_number = $teacher->mobile_number;
        }

        $admission_date = '';
        if(!empty($teacher->admission_date))
        {
            $admission_date = date('d-m-y' , strtotime($teacher->admission_date));
        }

        $teacher_status = $teacher->status == 1 ? 'Active' : 'Inactive';
        $date_of_birth = '';
        if(!empty($teacher->date_of_birth))
        {
            $date_of_birth = date('d-m-y' , strtotime($teacher->date_of_birth));
        }

        $admission_date = '';
        if(!empty($teacher->admission_date))
        {
            $admission_date = date('d-m-y' , strtotime($teacher->admission_date));
        }

        $Joining_Date = '';
        if(!empty($teacher->joining_date))
        {
            $Joining_Date = date('d-m-y' , strtotime($teacher->joining_date));
        }



        return [
            $teacher->id,
            $teacher_name,
            $teacher->email,
            $teacher->gender,
            $date_of_birth,
            $mobile_number,
            $Joining_Date,
            $teacher->marital_status,
            $teacher->address,
            $teacher_status,
            $admission_date,
            date('d-m-y' , strtotime($teacher->created_at)),

        ];
    }

    public function collection()
    {
        $remove_pagination = 1;
        return User::getTeacher($remove_pagination);
    }


}