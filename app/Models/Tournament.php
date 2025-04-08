<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'photo',
        'format',
        'max_participants',
        'reward',
        'rules',

    ];


    public function user()
    {
        return $this->hasOne(Organisator::class);
    }


}


