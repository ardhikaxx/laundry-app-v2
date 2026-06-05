<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@cuciin.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
        User::create([
            'name'     => 'Pengunjung',
            'email'    => 'umum@cuciin.com',
            'password' => Hash::make('password'),
            'role'     => 'umum',
        ]);
    }
}
