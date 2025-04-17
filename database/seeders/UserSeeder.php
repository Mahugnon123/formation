<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert([
                'nom' => 'admin',
                'prenom' => 'admin',
                'role_id' => 3,
                'email' => 'admin@gmail.com',
                'slug' => Helpers::generateSlug(),
                'email_verified_at' => now(),
                'password' => Hash::make('1234567890'), // password
                'remember_token' => Str::random(10),
            ]);
        
    }
}
