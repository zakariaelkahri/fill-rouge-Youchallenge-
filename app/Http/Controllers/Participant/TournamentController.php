<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Services\Participant\TournamentService;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    protected $tournamentService ;

    public function __construct(TournamentService $tournamentService)
    {
     $this->tournamentService = $tournamentService;
    }

    public function index(){

        $tournaments = $this->tournamentService->displayTournaments();

        return view('participant.tournaments',compact('tournaments')) ;
        
    }

    public function show($id){

        $tournament = $this->tournamentService->showTournament($id);
        return view('participant.tournamentdetailes',compact('tournament')) ;

    }
}
