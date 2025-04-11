<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Repositories\BuyerRepository;
use App\Repositories\OrganisatorRepository;
use App\Repositories\ParticipantRepository;
use App\Repositories\SellerRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;




class UserService
{

    protected $userRepository;
    protected $organisatorRepository;
    protected $participantRepository;

    public function __construct(UserRepository $userRepository, OrganisatorRepository $organisatorRepository, ParticipantRepository $participantRepository)
    {
        $this->userRepository = $userRepository;
        $this->organisatorRepository = $organisatorRepository;
        $this->participantRepository = $participantRepository;
    }

    public function edite($request,User $user)
    {
        $status = $request->status;
        $usertype = $user->roles->first()->name;
        if($usertype ==='participant'){
            $participant = $user->participant;
           $this->participantRepository->edite($status,$participant);

           return;
        }elseif($usertype ==='organizator'){
            $organisator = $user->organisator;
           $this->organisatorRepository->edite($status,$organisator);
            
           return;
         }
            


    }





}
