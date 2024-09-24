<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password' => Hash::make('@admin123'),
        ]);

        $admin->assignRole('admin');

        $client = User::create([
            'name' => 'Cliente 1',
            'email' => 'client@mail.com',
            'password' => Hash::make('@client123'),
        ]);

        $client->assignRole('client');
    }
}

