<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\StudentAttendanceModel;

class ExportattendanceReport implements FromCollection, WithHeadings, WithMapping
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
            'Attendance',
            'Attendance Date',
            'Created By',
            'Created Date',
        ];
    }

   public function map($attendance): array
    {
        $attendance_type='';
        if($attendance->attendance_type == '1')
        {
            $attendance_type = 'Present';
        } 
        elseif($attendance->attendance_type == '2')
        {
            $attendance_type = 'Late';
        } 
        elseif($attendance->attendance_type == '3')
        {
            $attendance_type = 'Absent';
        }
        elseif($attendance->attendance_type == '4')
        {
            $attendance_type = 'Half Day';
        }

        return [
            $attendance->student_id,
            $attendance->student_name . ' ' . $attendance->student_last_name,
            $attendance->class_name,
            $attendance_type,
            $attendance->attendance_date,
            $attendance->created_name,
            $attendance->created_at,
        ];
    }

    public function collection()
    {
       $remove_pagination = 1;
        return StudentAttendanceModel::getRecord($remove_pagination);
    }
}
