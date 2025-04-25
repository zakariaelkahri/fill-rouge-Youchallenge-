<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Tournament;
use App\Services\Participant\TournamentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function showMyTournament(){
        
        $participant = Participant::where('user_id',Auth::user()->id)->first();
        $teams = $participant->teams ;
        $tournaments = [];
        foreach($teams as $team){

            $tournaments[] = Tournament::whereHas('teams',function ($query) use ($team) {

                $query->where('id',$team->id);

            })->first();

        }        
        
        return view('participant.mytournaments',compact('tournaments')) ;

    }

}
