<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditeUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = User::with('roles', 'participant', 'organisator')->whereHas('roles', function ($query) {
            $query->whereIn('name', ['organizator', 'participant']);
        })->paginate(5);
        
        return view('admin.manageusers', compact('users'));
    }

    public function edite(EditeUserRequest $request, User $user)
    {
        $rederiction = redirect()->route('admin.manageusers')->with('success', 'User status updated successfully!');
        if($user->participant){
            if($request->status == $user->participant->status){
                return $rederiction ;
            }
        }elseif($user->organisator){
            if($request->status == $user->organisator->status){
                return $rederiction ;
            }
        }
        $this->userService->edite($request, $user);
        
        return $rederiction ;
        
    }

    // public function show($id)
    // {
    //     $user = User::with('roles')->findOrFail($id);
    //     return view('admin.users.show', compact('user'));
    // }

    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();

    //     return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    // }
}
