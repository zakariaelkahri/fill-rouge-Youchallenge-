<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditeUserRequest;
use App\Models\Organisator;
use App\Models\Participant;
use App\Models\Tournament;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Exception;

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
        $rederiction = redirect()->route('showloginform')->with('success', 'User status updated successfully!');
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
        
        return  redirect()->route('admin.manageusers')->with('success', 'User status updated successfully!');      
        
    }

    public function show()
    {
        try{

            $tournaments = Tournament::all();
            $activeTournaments = $tournaments->where('is_validated',1)->where('status','ongoing');
            $users = User::all();
            $organisators = Organisator::all();

            // dd($activeTournaments);
            // dd('stop');
            $participant = Participant::all();
            $statistics = [
                ['label' => 'Total Users', 'value' => count($users), 'icon' => 'users'],
                ['label' => 'Total Tournaments', 'value' => count($tournaments), 'icon' => 'trophy'],
                ['label' => 'Total Active Tournaments', 'value' => count($activeTournaments), 'icon' => 'play-circle'],
                ['label' => 'Total Teams', 'value' => 15, 'icon' => 'users-cog'],
                ['label' => 'Total Players', 'value' => count($participant), 'icon' => 'user-friends'],
                ['label' => 'Total Matches', 'value' => 25, 'icon' => 'futbol'],
                ['label' => 'Total Completed Matches', 'value' => 20, 'icon' => 'check-circle'],
                ['label' => 'organisators validated', 'value' => count($organisators), 'icon' => 'calendar-alt'],
            ];
         

            return view('admin.statistics', compact('statistics'));

        }catch(\Exception $e){
            
            return view('admin.statistics')->with('error','failed to get statistics');

        }
    }


    public function display(){

        try{

            $tournaments = Tournament::paginate(3);
            // dd($tournaments);

            return view('admin.managetournaments',compact('tournaments'));

        }catch(\Exception $e){

            return abort(404,'somthing went wrong!');

        }


    }


    public function update(Request $request){

        try{

            $tournament_id = $request->only('tournament_id');
            $is_validated = $request->only('is_validated');
            
            $tournament = Tournament::where('id',$tournament_id['tournament_id'])->first();
            $tournament->is_validated = $is_validated['is_validated'];
            $tournament->save();

            return redirect()->back()->with('success','Validation Opiration Seccessfully');

        }catch(\Exception $e){

            return abort(404,'somthing went wrong!');

        }


    }




}
