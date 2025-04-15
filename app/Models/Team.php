<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
