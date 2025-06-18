<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use App\Models\School_Class;

class ExportStudent implements FromCollection , WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {     
        return [
            'Student ID',
            'Student Name',
            'Class',
            'Admission Number',
            'Admission Date',
            'Email',
            'Mobile',
            'Date of Birth',
            'Gender',
            'Caste',
            'Religion',
            'Blood Group',
            'Height',
            'Weight',
            'Status',
            'Created At',
        ];
    }

   public function map($student): array
    {
        $student_name = $student->first_name . ' ' . $student->last_name;

        $date_of_birth = '';
        if(!empty($student->date_of_birth))
        {
            $date_of_birth = date('d-m-y' , strtotime($student->date_of_birth));
        }

        $admission_number = '';
        if(!empty($student->admission_number))
        {
            $admission_number = $student->admission_number;
        }

        $admission_date = '';
        if(!empty($student->admission_date))
        {
            $admission_date = date('d-m-y' , strtotime($student->admission_date));
        }

        $student_status = $student->status == 1 ? 'Active' : 'Inactive';

        $create_date = '';
        if(!empty($student->created_at))
        {
            $create_date = date('d-m-y' , strtotime($student->created_at));
        }

        return [
            $student->id,
            $student_name,
            $class = School_Class::getSingle($student->class_id)->name ?? 'N/A',
            $admission_number,
            $admission_date,
            $student->email,
            $student->mobile,
            $date_of_birth,
            $student->gender,
            $student->caste,
            $student->religion,
            $student->blood_group,
            $student->height,
            $student->weight,
            $student_status,
            $create_date,
        ];
    }

    public function collection()
    {
        $remove_pagination = 1;
        return user::getStudent( $remove_pagination);
    }
}
