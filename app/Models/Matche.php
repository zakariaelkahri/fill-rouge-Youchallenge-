<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\matches;

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


    public function getTeamName($id){

        $team = Team::where('id',$id)->first();
        $name = $team->name ;
        return $name ;

    }


    public function getTeamPhotoUrl($id){

        $team = Team::where('id',$id)->first();
        $photo = $team->getPhotoUrl() ;
        return $photo ;

    }

    public function getResault($id){

        $resault = Resault::where('match_id',$id)->first();
        
        return $resault;

    }

}


