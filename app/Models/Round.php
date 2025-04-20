<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;
//     - id : int 
// - round: int
// - status: string
    protected $fillable = [

        'round',
        'status',

    ];


    public function teams(){

        return $this->belongsToMany(Team::class);

    }

    public function matches(){

        return $this->hasMany(matche::class);

    }


}
