<?php

namespace App\Repositories\Participant;

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
    ->paginate(2);
    ;
    // dd($tournaments);

     return $tournaments;

}

public function showTornament($id)
{

    $tournament = Tournament::where('id',$id)->first();

    return $tournament ;

}




}