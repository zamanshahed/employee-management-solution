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

// employee home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_auth_check');

// Owner home
Route::get('/owner/home', [App\Http\Controllers\HomeController::class, 'ownerIndex'])->name('owner.home')->middleware('is_auth_check');