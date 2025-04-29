<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(1);
        $permissions_admin = Permission::whereIn('name', [
            'manage_users',
            'manage_tournaments',
            'manage_teams',
            'manage_players',
            'manage_matches',
            'manage_settings'
        ])->get();
        
        $organisator = Role::find(2);
        $permissions_organisator = Permission::whereIn('name', [
            'create_tournament',
            'update_tournament',
            'delete_tournament',
            'manage_teams',
            'manage_players',
            'manage_matches',
            'manage_team',
            'manage_players',
            'submit_results'
        ])->get();
        
        $participant = Role::find(3);
        $permissions_participant = Permission::whereIn('name', [
            'view_tournaments',
            'view_matches',
            'participate',
            'view_rankings'
        ])->get();

        $admin->Permissions()->syncWithoutDetaching($permissions_admin->pluck('id'));
        $organisator->Permissions()->syncWithoutDetaching($permissions_organisator->pluck('id'));
        $participant->Permissions()->syncWithoutDetaching($permissions_participant->pluck('id'));



    }
}
