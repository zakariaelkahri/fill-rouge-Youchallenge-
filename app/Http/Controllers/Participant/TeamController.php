<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTeamRequest;
use App\Services\Participant\TeamService;
use Exception;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    public function store(CreateTeamRequest $request)
    {
        // "tournament_id" => "1"
        // "name" => "Clio Harvey"
        // "photo" => null
        // "team_bio" => "Tempora ad sapiente"
      
        try
        {
        $data = $request->only('tournament_id','name','photo','team_bio');

        $team = $this->teamService->store($data);
        
        if (!$team) {
            // dd('error');
            throw new Exception('An error occurred during registration. Please try again.');
        }
        
        return redirect()->back()->with('success','team created successfuly !');
        } catch (\Exception $e) {
            dd('error');

            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
       
    }

}
