<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::Find(1);
        $user->roles()->syncWithoutDetaching(1);

        $organisatorUsers = User::where('email', 'like', 'organisator%@example.com')->get();
        foreach($organisatorUsers as $organisatorUser){

        $organisatorUser->roles()->syncWithoutDetaching(2);

        }

        $participantUsers = User::where('email', 'like', 'participant%@example.com')->get();

        foreach($participantUsers as $participantUser){

        $participantUser->roles()->syncWithoutDetaching(3);
            
        }
    }
}
