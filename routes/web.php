<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Organisator\TournamentController;

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


// Auth 
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin/statistics');
    })->name('admin.dashboard')->middleware('nocache');
    Route::get('/admin/manageusers', [UserController::class, 'index'])->name('admin.manageusers')->middleware('nocache');
    Route::patch('/edite/status/{user}', [UserController::class, 'edite'])->name('admin.managestatus');
});



// organizer
Route::middleware(['auth','role:organizator'])->middleware('nocache')->group(function(){
Route::get('/organisator/home', function () {
    return view('organisator/home');
})->name('organisator.home');
Route::get('/organisator/dashboard', function () {
    return view('organisator/dashboard');
})->name('organisator.dashboard');

Route::get('/organisator/create/tournament', function () {
    return view('organisator/createtournament');
})->name('organisator.createmytournament');

Route::get('/organisator/manage/tournament', function () {
    return view('organisator/managetournament');
})->name('organisator.managetournament');

Route::post('/organisator/createtournament', [TournamentController::class, 'store'])->name('organisator.tournament.store');

Route::get('/organisator/manage/tournament', [TournamentController::class, 'index'])->name('organisator.managetournament');

});


// participant
Route::get('/participant/home', function () {
    return view('participant/home');
})->name('participant.home')->middleware('role:participant')->middleware('nocache');


