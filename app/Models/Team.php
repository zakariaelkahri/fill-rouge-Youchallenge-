<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

   protected $fillable = [
    'team_manager',
    'tournament_id',
    ];

    public function participants(){

        return $this->belongsToMany(Participant::class);

    }


    public function tournament(){

        return $this->belongsTo(Tournament::class);

    }
}
