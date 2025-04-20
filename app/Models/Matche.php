<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matche extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'round_id',
        'team1_id',
        'team2_id',
        'winner_team',
        'loser_team',
        'status',
    ];


    public function Round(){

        return $this->belongsTo(Round::class);

    }

    public function resault(){

        return $this->hasOne(Resault::class);

    }
}


