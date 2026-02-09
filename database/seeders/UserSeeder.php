<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@prmi.com',
            'password' => 'password', // Gantilah password dengan yang aman
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@prmi.com',
            'password' => 'password', // Gantilah password dengan yang aman
            'role' => 'editor',
        ]);
    }

}
