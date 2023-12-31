<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuizStudentController;
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
  
    Route::get('/student/home', [CourseController::class, 'index'])->name('student.home');
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
  
    Route::get('/teacher/home', [CourseController::class, 'index'])->name('teacher.home');
    Route::get('quiz/{id}', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('quiz/create/{id}', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('quiz/create/{id}', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('quiz/update/{id}', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::post('quiz/update/{id}', [QuizController::class, 'update'])->name('quiz.update');
    Route::post('quiz/delete/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');
    Route::get('question/{id}', [QuestionController::class, 'index'])->name('question.index');
    Route::get('question/create/{id}', [QuestionController::class, 'create'])->name('question.create');
    Route::post('question/create/{id}', [QuestionController::class, 'store'])->name('question.store');

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

Route::get('notifications/all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

Route::get('start/quiz/{id}', [QuizStudentController::class, 'startQuizPage'])->name('start-quiz');

Route::post('start/quiz/{id}',[QuizStudentController::class, 'startQuiz'])->name('start-quiz-submit');

Route::post('submit/quiz/{quiz}',[QuizStudentController::class, 'submitQuiz'])->name('quiz-submit');

Route::get('score/quiz/{quiz}',[QuizStudentController::class, 'getQuizScore'])->name('quiz-score');