<?php

namespace App\Services\Participant;

use App\Models\Role;
use App\Models\team;
use App\Models\Tournament;
use App\Models\User;
use App\Repositories\BuyerRepository;
use App\Repositories\Participant\TournamentRepository;
use App\Repositories\OrganisatorRepository;
use App\Repositories\Participant\TeamRepository;
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




class TeamService
{

    protected $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    
    }

 

    public function store(array $data){
        
        $photoFile = null;
        if (isset($data['photo'])) {
            $photoFile = $data['photo'];
            unset($data['photo']);
        }
        
        // dd($test);
        $participant = Auth::user()->participant;
        $data['invitation_code'] = random_int(100000, 999999) ; 
        $data['team_captain'] = $participant->id ; 
        $data['participated_members'] = 1;

        $tournament = Tournament::where('id',$data['tournament_id'])->first();
        $tournament->particpated_teams++ ;
        $tournament->save();
        // dd($tournament->particpated_teams);
        $team = $this->teamRepository->create($data);
        $participant->teams()->syncWithoutDetaching($team->id);

        
        if ($photoFile && $photoFile->isValid()) {
            try {
                $filename = $team->id . '_' . time() . '.' . $photoFile->getClientOriginalExtension();
                
                $path = $photoFile->storeAs('teams_photo', $filename, 'public');
                
                $team->update(['photo' => $path]);
                
                Log::info('team photo uploaded for user ID: ' . $team->id);
            } catch (\Exception $e) {
                Log::error('team photo upload failed: ' . $e->getMessage());
            }
        }


        return $team ;

    }   


    }







