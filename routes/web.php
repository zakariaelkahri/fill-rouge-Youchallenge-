<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('accueil');
});

Route::get('/showloginform', function () {
    return view('login');
})->name('showloginform');

Route::get('/showregisterform', function () {
    return view('register');
})->name('showregisterform');

Route::get('/home', function () {
    return view('accueil');
})->name('home');

Route::get('/dashboard', function () {
    return view('admin/statistics');
})->name('dashboard')->middleware('role:admin')->middleware('nocache');

Route::get('/organisator/home', function () {
    return view('organisator/home');
})->name('organisator.home')->middleware('role:organisator')->middleware('nocache');

Route::get('/participant/home', function () {
    return view('participant/home');
})->name('participant.home')->middleware('role:participant')->middleware('nocache');

// Auth 
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/manageusers', [UserController::class, 'index'])->name('admin.manageusers')->middleware('nocache');
    Route::patch('/edite/status/{user}', [UserController::class, 'edite'])->name('admin.managestatus');
    
});
