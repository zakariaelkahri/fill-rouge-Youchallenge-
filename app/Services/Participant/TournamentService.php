<?php

namespace App\Services\Participant;

use App\Models\Role;
use App\Models\Tournament;
use App\Models\User;
use App\Repositories\BuyerRepository;
use App\Repositories\Participant\TournamentRepository;
use App\Repositories\OrganisatorRepository;
use App\Repositories\ParticipantRepository;
use App\Repositories\SellerRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;




class TournamentService
{

    protected $tournamentRepository;


    public function __construct(TournamentRepository $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    
    }

 

    public function displayTournaments(){

        $tournaments = $this->tournamentRepository->displayTournaments();

        return $tournaments;

    }   
     public function showTournament($id){

        $tournament = $this->tournamentRepository->showTornament($id);

        
        return $tournament;

    }






}
