<?php

namespace App\Http\Controllers\Organisator;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthGates;
use App\Http\Requests\CreateRoundRequest;
use App\Http\Requests\StoreTournamentRequest;
use App\Models\Organisator;
use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Services\Organisator\TournamentService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoundController extends Controller
{
    protected $tournamentService ;

    public function __construct(TournamentService $tournamentService)
    {
        $this->tournamentService = $tournamentService;
    }

    public function create($id)
    {
        
        $round = $this->tournamentService->createRound($id);
        $round_one = $this->tournamentService->createRoundMatches($round);
        dd('here');
            //     try {
    //     $ = $this->tournamentService->store($data);
    //     Log::info('tournament created successfully' . $tournement->name);


    //     if (!$round) {
                // return ;
    //     }
        
    //     return  redirect()->route('organisator.dashboard')->with('success', 'tournament created successfully!');
    // } catch (\Exception $e) {
    //     Log::error('creation tournament error: ' . $e->getMessage());
    //     return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
    // }

    }



    // public function index(){
        
    //     $organisator_id = Auth::user()->organisator->id;
    //     $tournaments = $this->tournamentService->displayTournaments($organisator_id);
    //     return view('organisator/managetournament',compact('tournaments'));
    // }



    // public function show($id){
    //     $tournament_team = $this->tournamentService->showTournament($id);
    //     $tournament = $tournament_team[0];
    //     $teams = $tournament_team[1];
    //     // dd($tournament_team);
    //     return view('organisator/viewtournament',compact('tournament','teams'));
        
    // }

    

}