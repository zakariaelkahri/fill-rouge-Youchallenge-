<?php

namespace App\Services\Organisator;

use App\Models\Organisator;
use App\Models\Participant;
use App\Models\Role;
use App\Models\Round;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use App\Repositories\BuyerRepository;
use App\Repositories\Organisator\TournamentRepository;
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

    public function store(array $data)
    {

        $tournamentphoto = null;

        if(isset($data['photo'])){
            $tournamentphoto = $data['photo'];
            unset($data['photo']);
        }
        
        $data['organisator_id'] = Auth::user()->organisator->id;

        $tournement = $this->tournamentRepository->create($data);
        
        if ($tournamentphoto && $tournamentphoto->isValid()) {
            try {
                $filename = $tournement->id . '_' . time() . '.' . $tournamentphoto->getClientOriginalExtension();
                
                $path = $tournamentphoto->storeAs('tournament_photos', $filename, 'public');
                
                $tournement->update(['photo' => $path]);
                
                Log::info('tournament photo uploaded for tournament ID: ' . $tournement->id);
            } catch (\Exception $e) {
                Log::error('tournament photo upload failed: ' . $e->getMessage());
            }
        }

        return $tournement;
    }

    public function displayTournaments($organisator_id){

        $tournaments = $this->tournamentRepository->displayTournaments($organisator_id);
        return $tournaments;

    }   
     public function showTournament($id){

        $tournament = null;
        $organisator = Organisator::where('user_id',Auth::user()->id)->first();
        $participant = Participant::where('user_id',Auth::user()->id)->exists();

        if($participant){

            $tournament = Tournament::where('id',$id)->first();
        }else{
            
            $tournament = Tournament::where('id',$id)->where('organisator_id',$organisator->id)->first();
        }
        $teams = Team::where('tournament_id',$tournament->id)->get();
        $rounds = Round::whereHas('teams', function ($query) use ($tournament) {
        $query->where('tournament_id', $tournament->id)->where('eliminated',0);
        })->first();

        
        return [$tournament,$teams,$rounds];

    }

    public function createRound($id){
        
        // dd($id);

        $round = $this->tournamentRepository->createRound($id) ;

        return $round ;

    }


    public function createRoundMatches($round){

        $matches = $this->tournamentRepository->createRoundMatches($round) ;

        return $matches ;

    }




}


