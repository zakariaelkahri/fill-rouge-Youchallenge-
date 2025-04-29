<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , $role)

    {
        // dd(Auth::user());
        if(!Auth::check()){

            return redirect('showloginform');

        }
        $auth_role =  Auth::user()->roles->first()->name;
        if($auth_role !== $role){

            abort(403,"Unauthorized it should be ".$role);

        }

        return $next($request);
    }
}
