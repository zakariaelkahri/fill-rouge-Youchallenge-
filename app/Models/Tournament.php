<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'organisator_id',
        'name',
        'photo',
        'format',
        'max_participants',
        'reward',
        'rules',
        'start_date',

    ];


    public function organisator()
    {
        return $this->belongsTo(Organisator::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }


    public function getPhotoUrl()
   {
       if ($this->photo && Storage::disk('public')->exists($this->photo)) {
           return Storage::url($this->photo);
       }
       
       return asset('storage/images/default.png');
   }


}


