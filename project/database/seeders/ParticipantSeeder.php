<?php

namespace Database\Seeders;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    public function run()
    {
        $participantUsers = User::where('email', 'like', 'participant%@example.com')->get();

        foreach ($participantUsers as $user) {
            Participant::create([
                'user_id' => $user->id,
            ]);
        }
    }
}
