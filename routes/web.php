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
Route::post('login', [AuthController::class, 'AuthLogin']);
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
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'delete']);
    Route::get('admin/parent/my.student/{id}', [ParentController::class, 'MyStudent']);
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

});




Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
});


//teacher url
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/account', [UserController::class, 'myAccount']);
});

//student url



//parent url
Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
});
