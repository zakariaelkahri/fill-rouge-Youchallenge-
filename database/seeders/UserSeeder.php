<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name'=>'zakaria',
            'email'=>'zakaria@gmail.com',
            'password'=>hash::make('Mimo20032016'),
            'email_verified_at'=> now(),

        ]);
        // User::create([
        //     'role_id'=>2,
        //     'name'=>'hamza',
        //     'email'=>'hamza@.com',
        //     'password'=>hash::make('Mimo20032016'),
        //     'email_verified_at'=> now(),
            

        // ]);

        //         User::create([
        //     'role_id'=>4,
        //     'name'=>'simo',
        //     'email'=>'simo@.com',
        //     'password'=>hash::make('Mimo20032016'),
        //     'email_verified_at'=> now(),
            

        // ]);
        //         User::create([
        //     'role_id'=>2,
        //     'name'=>'issam',
        //     'email'=>'issam@.com',
        //     'password'=>hash::make('Mimo20032016'),
        //     'email_verified_at'=> now(),
            

        // ]); 
        //        User::create([
        //     'role_id'=>4,
        //     'name'=>'anouar',
        //     'email'=>'anouar@.com',
        //     'password'=>hash::make('Mimo20032016'),
        //     'email_verified_at'=> now(),
            

        // ]);
        //         User::create([
        //     'role_id'=>3,
        //     'name'=>'ayoub',
        //     'email'=>'ayoub@.com',
        //     'password'=>hash::make('Mimo20032016'),
        //     'email_verified_at'=> now(),
            

        // ]);
        //         User::create([
        //     'role_id'=>4,
        //     'name'=>'abdo',
        //     'email'=>'abdo@.com',
        //     'password'=>hash::make('Mimo20032016'),
        //     'email_verified_at'=> now(),
            

        // ]); 
        //        User::create([
        //     'role_id'=>2,
        //     'name'=>'yousef',
        //     'email'=>'yousef@.com',
        //     'password'=>hash::make('Mimo20032016'),
        //     'email_verified_at'=> now(),
        // ]);
            


    }
}
