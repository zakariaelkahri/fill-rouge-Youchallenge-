<?php

namespace App\Repositories\Participant;

use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class TournamentRepository
{

public function displayTournaments()
{    
    
    $tournaments = Tournament::where('is_validated', 1)
    ->where('status','upcoming')
    ->where('deleted',0)
    ->paginate(4);
    ;
    // dd($tournaments);

     return $tournaments;

}

public function showTornament($id)
{

    $tournament = Tournament::where('id',$id)->first();
    $teams = Team::where('tournament_id',$tournament->id)->get();
    return [$tournament,$teams] ;

}




}