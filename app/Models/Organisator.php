<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisator extends Model
{
    use HasFactory;

    protected $fillable = [

        'role_id',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tournament()
    {

        return $this->hasMany(Tournament::class);

    }



}
