<?php

namespace App\Repositories\Organisator;

use App\Models\Matche;
use App\Models\Round;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;

class TournamentRepository
{

public function create(array $data)
{    
    
    $tournament = Tournament::create($data);

     return $tournament;


}

public function displayTournaments($organisator_id)
{

    $tournaments = Tournament::where('is_validated', 1)
    ->where('organisator_id', $organisator_id)
    ->where('deleted',0)
    ->paginate(4);
    return $tournaments;

}

public function createRound($id)
{    
    $tournament = Tournament::where('id',$id);
    $teams = Team::where('tournament_id',$id)->get();
    $round = Round::create();
    $round = Round::where('id',$round->id)->first();

    // $tournament->status = 'ongoing';
    
    if($teams && $round){

        foreach($teams as $team){

            $round->teams()->syncWithoutDetaching($team->id);
            
        }
     return $round ;   

    }


     return ;


}

public function createRoundMatches($round){

    $data = [];

    $round_teams = $round->teams()->inRandomOrder()->where('eliminated',0)->get();
    $matche_number = count($round_teams);

    
    for($i=0 ; $i<$matche_number ; $i++){
        if($i%2 == 0){

            $data['round_id'] = $round->id;
            $data['team1_id'] = $round_teams[$i]->id;
            $data['team2_id'] = $round_teams[$i+1]->id;
            Matche::create($data);
            
        }
    }
    
    $matches = Matche::where('round_id',$round->id);
    // dd($matches);
    
    return $matches ;


}


}