<?php

namespace App\Http\Controllers\Organisator;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthGates;
use App\Http\Requests\CompleteTournamentRequest;
use App\Http\Requests\StoreTournamentRequest;
use App\Models\Organisator;
use App\Models\Participant;
use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Services\Organisator\TournamentService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class TournamentDashboardController extends Controller
{

    public function index(){


        $organisator = Organisator::where('user_id',Auth::user()->id)->first();
        $tournaments = Tournament::where('organisator_id',$organisator->id)->where('deleted',0)->where('is_validated',1)->get();

        return view('organisator/dashboard',compact('tournaments'));
    }

    public function delete(Request $request){

        try
        {

            $tournament = Tournament::findOrFail($request->input('tournament_id'));

            if (Gate::denies('update_tournament', $tournament)) {
                abort(403, 'You are not allowed to delete this tournament.');
            }

            $tournament->deleted = 1 ;
            $tournament->save();

            return redirect()->back()->with('success', 'deleted succsessfully');

        }catch (\Exception $e) {

                Log::error('deleted failed: ' . $e->getMessage());
                return redirect()->back()->with('failed', 'deleted failed');            

        }
    }

    public function edit(Request $request){

        try
        {

            $data = $request
            ->only(
            'tournament_id',
            'name',
            'format',
            'max_participants',
            'photo',
            'start_date',
            'reward',
            'rules') ;
            // dd($data);
            
            $tournament = Tournament::where('id',$data['tournament_id'])->first();
            $tournamentphoto = null;

            if(isset($data['photo'])){
                $tournamentphoto = $data['photo'];
                unset($data['photo']);
            }

            if ($tournamentphoto && $tournamentphoto->isValid()) {
                try {
                    $filename = $tournament->id . '_' . time() . '.' . $tournamentphoto->getClientOriginalExtension();
                    
                    $path = $tournamentphoto->storeAs('tournament_photos', $filename, 'public');
                    
                    $tournament->update(['photo' => $path]);
                    
                    Log::info('tournament photo uploaded for tournament ID: ' . $tournament->id);
                } catch (\Exception $e) {
                    Log::error('tournament photo upload failed: ' . $e->getMessage());
                }
            }



            $tournament->update($data);

            return redirect()->back()->with('success', 'deleted succsessfully');

        }catch (\Exception $e) {

            Log::error('deleted failed: ' . $e->getMessage());
            return redirect()->back()->with('failed', 'deleted failed');            

        }
    }
    
}    

    

