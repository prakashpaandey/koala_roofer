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
            ['email' => 'prakashpandey@gmail.com'],
            [
                'name' => 'Prakash Pandey',
                'password' => \Illuminate\Support\Facades\Hash::make('prakashpandey'),
                'email_verified_at' => now(),
            ]
        );
    }
}
