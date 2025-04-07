<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; 


class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->only('role', 'name', 'email', 'password', 'photo', 'password_confirmation');
            
            if (in_array($data['role'], [2, 3])) {

                $user = $this->authService->register($data);
                Log::info('User registered successfully with ID: ' . $user->id);
                
                if ($user->photo) {
                    Log::info('Profile photo uploaded for user: ' . $user->getPhotoUrl());
                } else {
                    Log::info('No profile photo uploaded for user');
                }
            } else {
                throw new Exception('Undefined role!');
            }
            
            if (!$user) {
                throw new Exception('An error occurred during registration. Please try again.');
            }
            
            return redirect()->route('showloginform')->with('success', 'Account created successfully! Please check your email');
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }
    
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email','password');
        try{
            
            $user= $this->authService->login($credentials);            
            $request->session()->regenerate();
            $role = $user->roles->first()->name;
            if($role === 'admin'){
            return redirect()->intended('dashboard');
            }elseif($role === 'organizator'){

            return redirect()->intended('organisator.home');
                
            }else{

            return redirect()->intended('participant.home');

            }

        }catch (\Illuminate\Auth\AuthenticationException $e) {

            return redirect()->back()->withInput()->withErrors(['login' => $e->getMessage()]);
        }
        // catch (\Exception $e) {

        //     return redirect()->route('verification.notice')->with(['verify_email_needed' => 'warning', 'action' => 'need-verify', 'message' => ' It seems that you have not verified your email address yet. Please check your inbox for the verification link.!']);

        // }
    
        return back()->withErrors([
            'login_failed' => 'email or password icorrect ',
        ])->withInput();
    }
    

    public function logout(Request $request){

        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('showloginform')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
        ]);
    }
}

