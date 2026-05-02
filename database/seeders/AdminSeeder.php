<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin_sirata@stimata.ac.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Sirata#26'),
                'role' => 'admin',
                'is_protected' => true
            ]
        );
    }
}
