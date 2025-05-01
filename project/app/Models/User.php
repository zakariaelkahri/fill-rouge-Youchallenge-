<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'status',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function participant()
    {
        return $this->hasOne(Participant::class);
    }

    public function organisator()
    {
        return $this->hasOne(Organisator::class);
    }

    public function getPhotoUrl()
    {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            $url = Storage::url($this->photo);
            return asset($url);
        }

        return asset('storage/images/default.png');
        
    }
    
}
