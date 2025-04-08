<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $roles = Role::with('permissions')->get();
            $permissionsArray = [];

            foreach ($roles as $role) {
                foreach ($role->permissions as $permission) {
                    $permissionsArray[$permission->name][] = $role->id;
                }
            }

            foreach ($permissionsArray as $name => $roles) {
                Gate::define($name, function (User $user) use ($roles) {
                    return $user->roles->pluck('id')->intersect($roles)->isNotEmpty();
                });
            }
        }

        return $next($request);
    }
}
