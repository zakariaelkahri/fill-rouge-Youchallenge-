<?php

namespace App\Repositories\Organisator;

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
    ->paginate(2);
    ;
    return $tournaments;

}


}