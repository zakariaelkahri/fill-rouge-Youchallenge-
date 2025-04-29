<?php

namespace App\Repositories;

use App\Models\Organisator;

class OrganisatorRepository
{

public function create($user_id):Organisator
{

    return Organisator::create($user_id);

}




}