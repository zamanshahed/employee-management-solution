<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Auth::routes(['register' => false]);

// employee home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Owner home
Route::get('/owner/home', [App\Http\Controllers\HomeController::class, 'ownerIndex'])->name('owner.home')->middleware('is_owner_check');

// Owner: Add User
Route::get('/employee/add', [App\Http\Controllers\EmployeeController::class, 'addEmployee'])->name('employee.add')->middleware('is_owner_check');
// Owner: Save User
Route::post('/employee/add', [App\Http\Controllers\EmployeeController::class, 'saveEmployee'])->name('employee.save')->middleware('is_owner_check');

// Employee attendance page
Route::get('/employee/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('employee.attendace');