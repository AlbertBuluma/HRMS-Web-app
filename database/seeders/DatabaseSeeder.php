<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'administrator',
            'email' => 'administrator@email.com',
            'password' => Hash::make('password'),
            'remember_token' => 'ZCOibwOCHn',
        ]);

        Staff::factory(20)->create();
    }
}
