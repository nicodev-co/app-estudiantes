<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TeacherSeeder::class,
        ]);

        User::create([
            'name' => 'Angela',
            'email' => 'angela@example.com',
            'password' => User::generatePassword('Angela', '123456789'),
            'role' => 'admin',
            'document' => '123456789'
        ]);
    }
}
