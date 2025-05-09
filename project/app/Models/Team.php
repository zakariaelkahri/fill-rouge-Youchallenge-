<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasFactory;

   protected $fillable = [
    'tournament_id',
    'name',
    'photo',
    'team_bio',
    'participated_members',
    'invitation_code',
    'team_captain'
    ];
    // "tournament_id" => "1"
    // "name" => "Octavius Conrad"
    // "team_bio" => "Sunt deserunt neque"
    // "invitation_code" => 886775
    // "team_captain" => 1
  

    public function participants(){

        return $this->belongsToMany(Participant::class);

    }


    public function tournament(){

        return $this->belongsTo(Tournament::class);

    }

    public function Rounds(){

        return $this->belongsToMany(Round::class);

    }
    

    public function getPhotoUrl()
    {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            $url = Storage::url($this->photo);
            return asset($url);
        }

        return asset('storage/images/default.png');
    }

    public function getTeamCaptainName(){

        $teamCaptain = Participant::where('id',$this->team_captain)->first();
        $captainName = User::where('id',$teamCaptain->user_id)->first();
        return $captainName->name ; 

    }




}
