<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\BuyerRepository;
use App\Repositories\OrganisatorRepository;
use App\Repositories\ParticipantRepository;
use App\Repositories\SellerRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class AuthService
{
    protected $userRepository;
    protected $organisatorRepository;
    protected $participantRepository;

    public function __construct(UserRepository $userRepository, OrganisatorRepository $organisatorRepository, ParticipantRepository $participantRepository)
    {
        $this->userRepository = $userRepository;
        $this->organisatorRepository = $organisatorRepository;
        $this->participantRepository = $participantRepository;
    }

    public function register(array $data)
    {
        if ($data['role'] === '2') {
            return $this->registerOrganisator($data);
        } elseif ($data['role'] === '3') {
            return $this->registerParticipant($data);
        }
    }

    public function registerUser(array $data)
    {
        $photoFile = null;
        if (isset($data['photo'])) {
            $photoFile = $data['photo'];
            unset($data['photo']);
        }
        
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);
        if($data['role'] === '2'){

            $user->update(['status'=>'inactive']);

        }

        
        if ($photoFile && $photoFile->isValid()) {
            try {
                $filename = $user->id . '_' . time() . '.' . $photoFile->getClientOriginalExtension();
                
                $path = $photoFile->storeAs('profile_photos', $filename, 'public');
                
                $user->update(['photo' => $path]);
                
                Log::info('Profile photo uploaded for user ID: ' . $user->id);
            } catch (\Exception $e) {
                Log::error('Profile photo upload failed: ' . $e->getMessage());
            }
        }
        
        return $user;
    }

    public function registerOrganisator(array $data)
    {
        $user = $this->registerUser($data);
        $user->roles()->syncWithoutDetaching(2);
        $organisator = $this->organisatorRepository->create(['user_id' => $user->id]);
        return $user;
    }

    public function registerParticipant(array $data)
    {
        $user = $this->registerUser($data);
        $user->roles()->syncWithoutDetaching(3);
        $participant = $this->participantRepository->create(['user_id' => $user->id]);
        return $user;
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw new Exception('The provided email or password is incorrect. Please try again.');
        }

        // if (!Auth::user()->email_verified_at) {
        //     throw new Exception('Please verify your email address to continue.');
        // }

        request()->session()->regenerate();
        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();
    }
}