<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resault extends Model
{
    use HasFactory;

    protected $fillable = [

        'match_id',
        'score_team1',
        'score_team2',

    ];

    public function matche(){

        return $this->belongsTo(Matche::class);

    }

    
}
