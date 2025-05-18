<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\SubjectClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\HomeworkController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Auth url
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password', [AuthController::class, 'submitForgotPassword']);

// admin url
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/account', [UserController::class, 'myAccount']);
    Route::post('admin/account', [UserController::class, 'updateMyAdminAccount']);

    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);

    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);

     // parent
    Route::get('admin/parent/list', [ParentController::class, 'list']);
    Route::get('admin/parent/add', [ParentController::class, 'add']);
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/update/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    Route::get('admin/parent/search/', [ParentController::class, 'search']);

    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'delete']);
    Route::get('admin/parent/my_student/{id}', [ParentController::class, 'MyStudent']);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent']);
    Route::get('admin/parent/assign_student_parent-delete/{student_id}', [ParentController::class, 'AssignStudentParentDelete']);

    //School classes
    Route::get('admin/school_classes/list', [SchoolClassController::class, 'list'])->name('school_classes.list');
    Route::get('admin/school_classes/add', [SchoolClassController::class, 'add'])->name('school_classes.add');
    Route::post('admin/school_classes/add', [SchoolClassController::class, 'store'])->name('school_classes.store');
    Route::get('admin/school_classes/{id}/edit', [SchoolClassController::class, 'edit'])->name('school_classes.edit');
    Route::put('admin/school_classes/{id}/update', [SchoolClassController::class, 'update'])->name('school_classes.update');
    Route::delete('admin/school_classes/{id}/destroy', [SchoolClassController::class, 'destroy'])->name('school_classes.destroy');
    Route::get('admin/school_classes/search', [SchoolClassController::class, 'search'])->name('school_classes.search');

    //School subjects
    Route::get('admin/subjects/list', [SubjectController::class, 'list'])->name('subjects.list');
    Route::get('admin/subjects/add', [SubjectController::class, 'add'])->name('subjects.add');
    Route::post('admin/subjects/add', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('admin/subjects/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('admin/subjects/{id}/update', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('admin/subjects/{id}/destroy', [SubjectController::class, 'destroy'])->name('subjects.destroy');
    Route::get('admin/subjects/search', [SubjectController::class, 'search'])->name('subjects.search');

   //Assign Subject to Class
   Route::get('admin/assign_subject/list', [SubjectClassController::class, 'list'])->name('assign_subjects.list');
   Route::get('admin/assign_subject/add', [SubjectClassController::class, 'add'])->name('assign_subjects.add');
   Route::post('admin/assign_subject/add', [SubjectClassController::class, 'store'])->name('assign_subjects.store');
   Route::delete('admin/assign_subject/{class_id}/{subject_id}/destroy', [SubjectClassController::class, 'destroy'])->name('assign_subjects.destroy');
   //Assign Class to Teacher
   Route::get('admin/assign_class_teacher/list', [AssignClassTeacherController::class, 'list'])->name('assign_class_teacher.list');
   Route::get('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'add'])->name('assign_class_teacher.add');
   Route::post('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'insert'])->name('assign_class_teacher.insert');
   Route::get('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'edit']);
   Route::post('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'update']);
   Route::get('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'edit_single']);
   Route::post('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'update_single']);
   Route::get('admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class, 'delete']);

   //admin/change_password
   Route::get('admin/change_password', [UserController::class, 'change_password'])->name('change_password');
   Route::post('admin/change_password', [UserController::class, 'update_change_password'])->name('update_change_password');

   //change password
   Route::get('admin/change_password', [UserController::class, 'change_password'])->name('change_password');
   Route::post('admin/change_password', [UserController::class, 'update_change_password'])->name('update_change_password');
   //Class timetable
   Route::get('admin/class_timetable/list', [ClassTimetableController::class, 'list'])->name('class_timetable.list');
   Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class, 'getSubject'])->name('class_timetable.getSubject');
   Route::post('admin/class_timetable/add', [ClassTimetableController::class, 'insert_update'])->name('class_timetable.insert_update');

   //examinations

   Route::get('admin/examinations/exam/list', [ExaminationsController::class, 'exams_list']);
   Route::get('admin/examinations/exam/add', [ExaminationsController::class, 'exam_add']);
   Route::post('admin/examinations/exam/add', [ExaminationsController::class, 'exam_insert']);
   Route::get('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_edit']);
   Route::post('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_update']);
   Route::get('admin/examinations/exam/delete/{id}', [ExaminationsController::class, 'exam_delete']);

   //exam_schedule
   Route::get('admin/examinations/exam_schedule', [ExaminationsController::class, 'exam_schedule']);
   Route::post('admin/examinations/exam_schedule_insert', [ExaminationsController::class, 'exam_schedule_insert']);

   //mark register
   Route::get('admin/examinations/mark_register', [ExaminationsController::class, 'mark_register']);
   Route::post('admin/examinations/submit_mark_register', [ExaminationsController::class, 'submit_mark_register']);
   Route::post('admin/examinations/single_submit_mark_register', [ExaminationsController::class, 'single_submit_mark_register']);

   // marks grade
    Route::get('admin/examinations/marks_grade', [ExaminationsController::class, 'marks_grade']);
    Route::get('admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_add']);
    Route::post('admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_insert']);
    Route::get('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_edit']);
    Route::post('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_update']);
    Route::get('admin/examinations/marks_grade/delete/{id}', [ExaminationsController::class, 'marks_grade_delete']);
    // attendance
     Route::get('admin/attendance/student', [AttendanceController::class, 'attendanceStudent']);
     Route::post('admin/attendance/student/save', [AttendanceController::class, 'submitAttendanceStudent']);
     Route::get('admin/attendance/report', [AttendanceController::class, 'attendanceReport']);

    // communicate
     Route::get('admin/communicate/notice_board', [CommunicateController::class, 'noticeBoard']);
     Route::get('admin/communicate/notice_board/add', [CommunicateController::class, 'addNoticeBoard']);
     Route::post('admin/communicate/notice_board/add', [CommunicateController::class, 'insertNoticeBoard']);
     Route::get('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'editNoticeBoard']);
     Route::post('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'updateNoticeBoard']);
     Route::get('admin/communicate/notice_board/delete/{id}', [CommunicateController::class, 'deleteNoticeBoard']);
     Route::get('admin/communicate/send_email', [CommunicateController::class, 'sendEmail']);

     // homework
     Route::get('admin/homework', [HomeworkController::class, 'homework']);
     Route::get('admin/homework/add', [HomeworkController::class, 'add']);
     Route::post('admin/homework/add', [HomeworkController::class, 'insert']);
     Route::post('admin/ajaxGetSubject', [HomeworkController::class, 'ajaxGetSubject']);
     Route::get('admin/homework/edit/{id}', [HomeworkController::class, 'edit']);
     Route::post('admin/homework/edit/{id}', [HomeworkController::class, 'update']);
     Route::get('admin/homework/delete/{id}', [HomeworkController::class, 'delete']);
     Route::get('admin/homework/submitted_homework/{id}', [HomeworkController::class, 'submittedHomework']);
     Route::get('admin/homework/homework_report', [HomeworkController::class, 'homework_report']);



});

//student url
Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('student/my_calendar', [CalendarController::class, 'myCalendar']);
    Route::get('student/my_subjects', [SubjectController::class, 'mySubjects']);
    Route::get('student/my_timetable', [ClassTimetableController::class, 'myTimetable']);
    Route::get('student/my_exam_result', [ExaminationsController::class, 'myExamResult']);
    Route::get('student/my_exam_timetable', [ExaminationsController::class, 'myExamTimetable']);
    Route::get('student/my_attendance', [AttendanceController::class, 'myAttendanceStudent']);
    Route::get('student/my_notice_board', [CommunicateController::class, 'myNoticeBoardStudent']);
    Route::get('student/my_homework', [HomeworkController::class, 'myHomeworkStudent']);
    Route::get('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'submitHomework']);
    Route::post('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'insertSubmitHomework']);
    Route::get('student/my_submitted_homework', [HomeworkController::class, 'mySubmittedHomework']);
    Route::get('student/change_password', [UserController::class, 'change_password'])->name('change_password');
    Route::post('student/change_password', [UserController::class, 'update_change_password'])->name('update_change_password');
});

//teacher url
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/account', [UserController::class, 'myAccount']);
    Route::get('teacher/my_students', [StudentController::class, 'myStudents']);
    Route::get('teacher/my_calendar', [CalendarController::class, 'myCalendarTeacher']);
    Route::get('teacher/mark_register', [ExaminationsController::class, 'mark_register_teacher']);
    Route::post('teacher/submit_mark_register', [ExaminationsController::class, 'submit_mark_register']);
    Route::post('teacher/single_submit_mark_register', [ExaminationsController::class, 'single_submit_mark_register']);
    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'myClassSubject']);
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'myTimetableTeacher']);
    Route::get('teacher/my_exam_timetable', [ExaminationsController::class, 'myExamTimetableTeacher']);
    Route::get('teacher/attendance/student', [AttendanceController::class, 'attendanceStudentTeacher']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'submitAttendanceStudent']);
    Route::get('teacher/attendance/report', [AttendanceController::class, 'attendanceReportTeacher']);
    Route::get('teacher/homework', [HomeworkController::class, 'homeworkTeacher']);
    Route::get('teacher/homework/add', [HomeworkController::class, 'addHomeworkTeacher']);
    Route::post('teacher/homework/add', [HomeworkController::class, 'insertHomeworkTeacher']);
    Route::post('teacher/ajaxGetSubject', [HomeworkController::class, 'ajaxGetSubject']);
    Route::get('teacher/homework/edit/{id}', [HomeworkController::class, 'editHomeworkTeacher']);
    Route::post('teacher/homework/edit/{id}', [HomeworkController::class, 'updateHomeworkTeacher']);
    Route::get('teacher/homework/delete/{id}', [HomeworkController::class, 'deleteHomeworkTeacher']);
    Route::get('teacher/homework/submitted_homework/{id}', [HomeworkController::class, 'submittedHomeworkTeacher']);

    Route::get('teacher/my_notice_board', [CommunicateController::class, 'myNoticeBoardTeacher']);
    Route::get('teacher/change_password', [UserController::class, 'change_password'])->name('change_password');
    Route::post('teacher/change_password', [UserController::class, 'update_change_password'])->name('update_change_password');
});

//parent url
Route::group(['middleware' => 'parent'], function () {

    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('parent/change_password', [UserController::class, 'change_password'])->name('change_password');
    Route::post('parent/change_password', [UserController::class, 'update_change_password'])->name('update_change_password');
    Route::get('parent/account', [UserController::class, 'myAccount']);
    Route::post('parent/account', [UserController::class, 'updateMyAdminAccount']);

    Route::get('parent/my_student', [ParentController::class, 'myStudentParent']);



});
