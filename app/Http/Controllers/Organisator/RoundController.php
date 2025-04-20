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

                try {
   
        $round = $this->tournamentService->createRound($id);
        $matches = $this->tournamentService->createRoundMatches($round);
        dd('here');
        Log::info('tournament created successfully' . $tournement->name);


        if (!$round && $matches) {
                return redirect()->route('organisator.tournamentdetails')->with('failed', 'round not created !');
        }
        
        return redirect()->route('organisator.tournamentdetails')->with('success', 'round 1 created successfully !');
    
    } catch (\Exception $e) {
        Log::error('round 1 not created: ' . $e->getMessage());
        return redirect()->route('organisator.tournamentdetails')->with('failed', 'round not created !');
    }

    }

    

}