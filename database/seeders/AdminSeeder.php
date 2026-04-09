<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'info@bihanitech.com'],
            [
                'name' => 'Bihani Tech',
                'password' => \Illuminate\Support\Facades\Hash::make('bihanitech1234'),
                'email_verified_at' => now(),
            ]
        );
    }
}
