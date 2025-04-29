<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\joinTeamRequest;
use App\Services\Participant\TeamService;
use Exception;
use Illuminate\Support\Facades\Log;

class ParticipantController extends Controller
{
    
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    public function store(joinTeamRequest $request)
    {
      
        try
        {
        $data = $request->only('tournament_id','invitation_code');
        $attach = $this->teamService->join($data);
        
        if ($attach == null) {
            return redirect()->back()->with('joinfailed','The team you try to join is Full ');
        }
        
        
        return redirect()->back()->with('success','Join successfuly , Enjoy ');
        } catch (\Exception $e) {

            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->with('joinfailed','joining code incorect');
        }
       
    }

}
