<?php

namespace Database\Seeders;

use App\Models\Organisator;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrganisatorSeeder extends Seeder
{
    public function run()
    {
        $organisatorUsers = User::where('email', 'like', 'organisator%@example.com')->get();

        foreach ($organisatorUsers as $user) {
            Organisator::create([
                'user_id' => $user->id,
            ]);
        }
    }
}
