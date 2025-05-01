<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'team_mode',
        'particpated_teams',
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
        $url = Storage::url($this->photo);
        return asset($url);
    }

    return asset('storage/images/default.png');
   }


   public function isParticipating($userId)
   {

       return $this->teams()
           ->whereHas('participants', function($query) use ($userId) {
               $query->where('user_id', $userId);
           })
           ->exists();           

   }

   public function isTeamCaptain($id)
{

    $id = Participant::where('user_id',$id)->first()->id;

    return $this->teams()->where('team_captain',$id)->exists();
}


   public function getCaptainTeam($id){

    $id = Participant::where('user_id',$id)->first()->id;

    return $this->teams()->where('team_captain',$id)->first();

}

public function isTeamCaptaine($id)
{
    $id = Participant::where('user_id',$id)->first()->id;

    return $this->teams()->where('team_captain',$id)->exists();
}

public function getTeamName()
{
    $participant = Participant::where('user_id', Auth::id())->first();

    if (!$participant) {
        return null;
    }

    return $this->teams()
        ->whereHas('participants', function ($query) use ($participant) {
            $query->where('participant_id', $participant->id);
        })
        ->first();
}

}


