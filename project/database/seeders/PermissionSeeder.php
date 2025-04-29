<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    Permission::create(['name' => 'manage_users']);
        
    Permission::create(['name' => 'manage_tournaments']);

    Permission::create(['name' => 'manage_teams']);
        
    Permission::create(['name' => 'manage_Players']);
    
    Permission::create(['name' => 'manage_matches']);
    
    Permission::create(['name' => 'manage_settings']);
    
    Permission::create(['name' => 'create_tournament']);

    Permission::create(['name' => 'update_tournament']);

    Permission::create(['name' => 'delete_tournament']);

    Permission::create(['name' => 'manage_team']);
        
    Permission::create(['name' => 'submit_results']);
    
    Permission::create(['name' => 'view_tournaments']);
    
    Permission::create(['name' => 'view_matches']);
        
    Permission::create(['name' => 'participate']);
        
    Permission::create(['name' => 'view_rankings']);
  
    }
}
