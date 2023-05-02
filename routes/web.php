<?php

use App\Http\Controllers\Admin\AssignmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Student\SubmssionController;

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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth', 'user-access:student'])->group(function () {
  
    Route::get('/student/home', [HomeController::class, 'index'])->name('student.home');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/user/teacher',[UserController::class, 'indexTeacher'])->name('admin.user.teacher');
    Route::get('/admin/user/student',[UserController::class, 'indexStudent'])->name('admin.user.student');
    Route::get('/admin/user/admin',[UserController::class, 'indexAdmin'])->name('admin.user.admin');
    Route::resource('/admin/users', UserController::class);
    //Route::resource('/admin/courses', CourseController::class);
});


Route::middleware(['auth', 'user-access:teacher'])->group(function () {
  
    Route::get('/teacher/home', [HomeController::class, 'teacherHome'])->name('teacher.home');
});

Route::resource('/courses', CourseController::class);
Route::resource('/materials', MaterialController::class);

Route::get('{material}', [PdfController::class, 'index'])->name('file.open');
Route::get('/assignment/{assignment}', [PdfController::class, 'assignment'])->name('prompt.open');
Route::get('/submission/{submission}', [PdfController::class, 'submission'])->name('response.open');

Route::resource('/meetings', MeetingController::class)->except('create');
Route::get('/meetings/create/{course}', [MeetingController::class, 'create'])->name('meetings.create');

Route::resource('/assignments', AssignmentController::class)->except('create');
Route::get('/assignments/create/{course}', [AssignmentController::class, 'create'])->name('assignments.create');

Route::resource('/submissions', SubmssionController::class);
Route::get('assignment_submissions/{assignment}', [SubmssionController::class, 'specific'])->name('submissions.assignment');
