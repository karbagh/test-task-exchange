<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->forceCreate([
            'name' => 'Raina Orn',
            'email' => 'lakin.orpha@yahoo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }
}
