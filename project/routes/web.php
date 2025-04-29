<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Organisator\RoundController;
use App\Http\Controllers\Organisator\TournamentController;
use App\Http\Controllers\Organisator\TournamentDashboardController;
use App\Http\Controllers\Participant\ParticipantController;
use App\Http\Controllers\Participant\TeamController;
use App\Http\Controllers\Participant\TournamentController as ParticipantTournamentController;

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
})->name('accueil');

Route::get('/login', function () {
    return view('login');
})->name('showloginform');

Route::get('/register', function () {
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

    Route::get('/admin/manageusers', [UserController::class, 'index'])->name('admin.manageusers')->middleware('nocache');

    Route::patch('admin/edite/status/{user}', [UserController::class, 'edite'])->name('admin.managestatus')->middleware('nocache');

    Route::get('admin/show/statistics',[UserController::class, 'show'])->name('admin/statistics')->middleware('nocache'); 

    Route::get('admin/tournments',[UserController::class, 'display'])->name('admin.tournaments')->middleware('nocache'); 

    Route::patch('admin/update/tournament',[UserController::class, 'update'])->name('admin/apdate/tournament')->middleware('nocache'); 

});





// organizer
Route::middleware(['auth', 'role:organizator'])->group(function(){
Route::get('/organisator/home', function () {
    return view('organisator/home');
})->name('organisator.home');

Route::get('/organisator/create/tournament', function () {
    return view('organisator/createtournament');
})->name('organisator.createmytournament');

Route::get('/organisator/dashboard',[TournamentDashboardController::class, 'index'] )->name('organisator.dashboard');

Route::patch('/organisator/dashboard/delete',[TournamentDashboardController::class, 'delete'] )->name('organisator.tournament.delete');

Route::put('/organisator/dashboard/edit',[TournamentDashboardController::class, 'edit'] )->name('organisator.tournament.edit');

Route::post('/organisator/createtournament', [TournamentController::class, 'store'])->name('organisator.tournament.store');

Route::get('/organisator/manage/tournament', [TournamentController::class, 'index'])->name('organisator.managetournament');

Route::get('/organisator/tournament/details/{tournament}', [TournamentController::class, 'show'])->name('organisator.tournamentdetails');

Route::post('/organisator/start/tournament/{tournament}', [RoundController::class, 'store'])->name('organisator.start.tournament');

Route::patch('/organisator/save/round', [RoundController::class, 'edit'])->name('organisator.save.round');

Route::patch('/organisator/tournament/complete', [TournamentController::class, 'edit'])->name('organisator.tournament.complete');


});







// participant
Route::middleware(['auth', 'role:participant'])->group(function(){

Route::get('/participant/home', function () {
    return view('participant/home');
})->name('participant.home');

Route::get('/participant/tournaments', [ParticipantTournamentController::class , 'index'])->name('participant.tournaments');

Route::get('/participant/mytournaments', [ParticipantTournamentController::class , 'showMyTournament'])->name('participant.mytournaments');

Route::get('/participant/tournament/details/{tournament}', [ParticipantTournamentController::class , 'show'])->name('participant.tournament.details');

Route::get('/participant/mytournament/details/{tournament}', [TournamentController::class, 'show'])->name('participant.mytournament.details');

Route::post('participant/create/team',[TeamController::class,'store'])->name('participant.team.create');

Route::post('participant/join/team',[ParticipantController::class,'store'])->name('participant.join.team');

Route::delete('/participant/exit/tournament', [TeamController::class, 'destroy'])->name('participant.exit.team');


});

