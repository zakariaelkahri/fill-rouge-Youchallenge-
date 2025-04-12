<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data){

        $user = User::create($data);
        return $user;

    }

    public function all(){

        return User::all();

    }

    public function edite($status,$user)
{
    $user->status = $status;
    $user->save();
    return ;

}

    // public function findByEmail(array $data){

    //     return User::find($data);

    // }
}