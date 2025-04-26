<?php

namespace App\Http\Controllers\Organisator;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthGates;
use App\Http\Requests\CreateRoundRequest;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateRoundMatchesRequest;
use App\Models\Organisator;
use App\Models\Resault;
use App\Models\Round;
use App\Models\Team;
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

    public function store($id)
    {
        try {
        
            $tournament = Tournament::where('id',$id)->first();
            if ($tournament->max_participants > $tournament->particpated_teams ) 
            {
                return redirect()->back()->with('failed', 'number of participated teams not enough ! wait for tournament to be Full . ');
            }
            // dd($tournament);
            $round = $this->tournamentService->createRound($id);
            $matches = $this->tournamentService->createRoundMatches($round);
            $tournament->status = 'ongoing';
            $tournament->save();
            Log::info('round and matchs created successfully' );

            if (!$round && $matches ) {
                    return redirect()->back()->with('failed', 'round is not created !');
            }     


            
            return redirect()->back()->with('success', 'round 1 created successfully !');
        
        } catch (\Exception $e) {
            Log::error('round 1 not created: ' . $e->getMessage());
            return redirect()->back()->with('failed', 'round not created !');
        }

    }


    public function edit(UpdateRoundMatchesRequest $request){


        try{
        $data = $request
        ->only(       
            'round_id',
            'last_match',
            'matches',
        );

        
        $matche_data = [];
        $round = Round::where('id',$data['round_id'])->first();
        $matches = $round->matches()->get();
        $winner = null ;
        $data_match = 0 ;

        foreach($matches as $matche){
            
            if($matche->team1_id == $data['matches'][$data_match]['winner_id'] ){

                $matche->winner_team = $matche->team1_id ;
                $matche->loser_team = $matche->team2_id ; 
                $matche->status = 'finished';
                $matche->save();

                $winner = Team::where('id',$matche->team1_id)->first();

                $loser = Team::where('id',$matche->team2_id)->first();
                $loser->eliminated = 1;
                $loser->save();
                
                $matche_data['match_id'] = $data['matches'][$data_match]['id'];
                $matche_data['score_team1'] = $data['matches'][$data_match]['score_team1'];
                $matche_data['score_team2'] = $data['matches'][$data_match]['score_team2'];
                Resault::create($matche_data);

                $data_match++;

            }elseif(($matche->team2_id == $data['matches'][$data_match]['winner_id'])){
                $matche->winner_team = $matche->team2_id ;
                $matche->loser_team = $matche->team1_id ;
                $matche->status = 'finished'; 
                $matche->save();

                $winner = Team::where('id',$matche->team2_id)->first();

                $loser = Team::where('id',$matche->team1_id)->first();
                $loser->eliminated = 1;
                $loser->save(); 

                $matche_data['match_id'] = $data['matches'][$data_match]['id'];
                $matche_data['score_team1'] = $data['matches'][$data_match]['score_team1'];
                $matche_data['score_team2'] = $data['matches'][$data_match]['score_team2'];
                Resault::create($matche_data);
                
                $data_match++;


            }

            
            
        }


        $round->status = 'finished';
        $round->save();

        if($data['last_match'] != 1){

        return redirect()->back()->with('success', 'Data saved successfully !');

        }else{
            return redirect()->back()->with('lastRound', '🎉🎉 👏👏👏 Congrats '.$winner->name.' the winner👏👏👏  🎉🎉');

        }

        } catch(\Exception $e){
            Log::error('round 1 not created: ' . $e->getMessage());
            return redirect()->back()->with('failed', 'saving data failed !');

        }        

    
    }

}



