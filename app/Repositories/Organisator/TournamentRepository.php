<?php

namespace App\Repositories\Organisator;

use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;

class TournamentRepository
{

public function create(array $data)
{

    $data['organisator_id'] = Auth::user()->organisator->id ;
    // dd($data);
    
    $tournament = Tournament::create($data);
    // dd($tournament);

     return $tournament;

}




}