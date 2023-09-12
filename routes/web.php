<?php

use App\Http\Controllers\AccountReceivable;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InstructorModalityController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::resource('student', StudentController::class)->missing(function(Request $request) {
    return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
});
Route::resource('student/{student}/registration', RegistrationController::class, ['as' => 'student']);

Route::resource('instructor', InstructorController::class)->missing(function(Request $request) {
    return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
});

Route::resource('instructor/{instructor}/modality', InstructorModalityController::class, ['as' => 'instructor']);

Route::get('calendar/context/{data}', [CalendarController::class, 'context'])->name('calendar.context');
Route::get('calendar/remark/{class}', [CalendarController::class, 'remark'])->name('calendar.remark');
Route::get('calendar/trial/{class}', [CalendarController::class, 'trial'])->name('calendar.trial');
Route::resource('calendar', CalendarController::class);

Route::post('class/remark', [ClassesController::class, 'remark'])->name('class.remark');
Route::resource('class', ClassesController::class);


Route::resource('account/receivable', AccountReceivable::class);

Route::get('user/zipcode/{zipcode}', [UserController::class, 'zipcodeApi'])->name('user.zipcode');
Route::get('user/find/{phone}', [UserController::class, 'find'])->name('user.find');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
