<?php

namespace App\Repositories\Participant;

use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class TeamRepository
{



public function create($data)
{
    $team = Team::create($data);
    return $team ;

}

public function join($team){

    $participant = Auth::user()->participant;
    $attach = $participant->teams()->syncWithoutDetaching($team->id);
    return $attach ;
}




}