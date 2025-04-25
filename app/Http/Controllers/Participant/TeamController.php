<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTeamRequest;
use App\Models\Participant;
use App\Models\Team;
use App\Models\Tournament;
use App\Services\Participant\TeamService;
use Exception;
use Illuminate\Support\Facades\Auth;
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
      
        try
        {
        $data = $request->only('tournament_id','name','photo','team_bio');

        $team = $this->teamService->store($data);
        
        if ($team == null) {
            return redirect()->back()->with('joinfailed','Tournament Full, Can not create team  ');
        }
        
        return redirect()->back()->with('success','Team created successfuly , Enjoy');
        } catch (\Exception $e) {

            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->with('joinfailed','creating team Failed');
        }
       
    }

    public function destroy(Request $request ){
        try
        {
        $tournamant_id = $request->only('tournament_id',);
        
        $tournament = Tournament::where('id',$tournamant_id)->first();
        $teams = $tournament->teams ;
        $participant = Participant::where('user_id',Auth::user()->id)->first();
        foreach($teams as $team){

            $is_participated = $team->participants->where('id',$participant->id)->first();

            if( $is_participated && $team->participated_members > 1 && !$tournament->isTeamCaptain(Auth::user()->id)){

                $is_participated->teams()->detach($team->id);
                $team->participated_members--;
                $team->save();

            }else if( $is_participated && $team->participated_members > 1 && $tournament->isTeamCaptain(Auth::user()->id)){

                $team->participants()->detach($is_participated->id);
                $new_captain = $team->participants->first();
                $team->team_captain = $new_captain->id ; 
                $team->participated_members-- ;
                $team->save();

            }else if( $is_participated && $team->participated_members == 1 && $tournament->isTeamCaptain(Auth::user()->id)){

                $team->delete();
                $tournament->particpated_teams-- ;
                $tournament->save();

            }  
            
 
        }

        return redirect()->back()->with('success','You are out now ,you can join or create your own team ,see you champion ');

        } catch (\Exception $e) {

            Log::error('exit failed: ' . $e->getMessage());
            return redirect()->back()->with('joinfailed','something went wrong !! you can talk to support or try again after minuts');
        }


    }

}
