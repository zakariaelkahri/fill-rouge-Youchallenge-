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
    'invetation_code',
    'team_captain'
    ];

    public function participants(){

        return $this->belongsToMany(Participant::class);

    }


    public function tournament(){

        return $this->belongsTo(Tournament::class);

    }
}
