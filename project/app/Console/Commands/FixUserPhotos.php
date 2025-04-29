<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FixUserPhotos extends Command
{
    protected $signature = 'users:fix-photos';
    protected $description = 'Fix user photos stored as temporary paths';

    public function handle()
    {
        $users = User::whereNotNull('photo')->get();
        
        foreach ($users as $user) {
            // Skip photos that don't look like tmp paths
            if (!str_starts_with($user->photo, '/tmp/')) {
                continue;
            }
            
            $this->info("Processing user {$user->id} with photo {$user->photo}");
            
            // The tmp files are likely gone, so we'll clear the column
            $user->photo = null;
            $user->save();
            
            $this->info("Cleared tmp path for user {$user->id}");
        }
        
        $this->info('Photo cleanup completed.');
    }
}