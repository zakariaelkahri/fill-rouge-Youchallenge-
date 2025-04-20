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

        $team_tournament = $this->tournamentService->showTournament($id);
        $tournament = $team_tournament[0];
        $teams = $team_tournament[1];
        
        return view('participant.tournamentdetailes',compact('tournament','teams')) ;

    }
}
