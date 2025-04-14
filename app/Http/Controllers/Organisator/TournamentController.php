<?php

namespace App\Http\Controllers\Organisator;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthGates;
use App\Http\Requests\StoreTournamentRequest;
use App\Models\Organisator;
use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Services\Organisator\TournamentService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class TournamentController extends Controller
{
    protected $tournamentService ;

    public function __construct(TournamentService $tournamentService)
    {
         $this->tournamentService = $tournamentService;
    }

    public function store(StoreTournamentRequest $request)
    {

        $data = $request->only(       
        'name',
        'photo',
        'format',
        'max_participants',
        'team_mode',
        'start_date',
        'reward',
        'rules',
        );


        try {
        $tournement = $this->tournamentService->store($data);
        Log::info('tournament created successfully' . $tournement->name);
        
        if ($tournement->photo) {
            Log::info(' photo uploaded for tournement: ' . $tournement->getPhotoUrl());
        } else {
            Log::info('No profile photo uploaded for user');
        }

        if (!$tournement) {
            throw new Exception('An error occurred during creation. Please try again.');
        }
        
        return  redirect()->route('organisator.dashboard')->with('success', 'tournament created successfully!');
    } catch (\Exception $e) {
        Log::error('creation tournament error: ' . $e->getMessage());
        return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
    }

    }



    public function index(){
        
        $organisator_id = Auth::user()->organisator->id;
        $tournaments = $this->tournamentService->displayTournaments($organisator_id);
        return view('organisator/managetournament',compact('tournaments'));
    }

    public function show($id){
        $tournament = $this->tournamentService->showTournament($id);
        return view('organisator/viewtournament',compact('tournament'));
        
    }

}