<?php

namespace App\Repositories\Organisator;

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

    $teams = Team::where('tournament_id',$id)->get();
    $round = Round::create();
    $round = Round::where('id',$round->id)->first();
     
    if($teams && $round){

        foreach($teams as $team){

            $round->teams()->syncWithoutDetaching($team->id);
            
        }
     return $round ;   

    }


     return ;


}

public function createRoundMatches($round){

    $round_teams = $round->teams()->get();
    dd($round_teams);

}


}