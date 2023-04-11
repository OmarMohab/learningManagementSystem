<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\PdfController;

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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'user-access:student'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::resource('/admin/users', UserController::class);
    //Route::resource('/admin/courses', CourseController::class);
});


Route::middleware(['auth', 'user-access:teacher'])->group(function () {
  
    Route::get('/teacher/home', [HomeController::class, 'teacherHome'])->name('teacher.home');
});

Route::resource('/courses', CourseController::class);
Route::resource('/materials', MaterialController::class);

Route::get('{material}', [PdfController::class, 'index'])->name('file.open');

Route::resource('/meetings', MeetingController::class)->except('create');
Route::get('/meetings/create/{course}', [MeetingController::class, 'create'])->name('meetings.create');
