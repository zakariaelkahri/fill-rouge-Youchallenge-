<?php

namespace App\Repositories;

use App\Models\Participant;
use App\Models\Role;

class ParticipantRepository
{

    public function create($user_id):Participant
    {

        return Participant::create($user_id);  

}

public function edite($status,$participant)
{
    // dd($parti:cipant->status);
    $participant->status = $status;
    $participant->save();
    return ;

}

}