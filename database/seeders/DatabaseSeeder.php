<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \app\Models\User::factory(10)->create();

        \app\Models\User::factory()->create([
            'name' => 'qisti',
            'email' => 'qistiamaluddin7@gmail.com',
            'isAdmin' => 1,
            'password' => '12345678',
        ]);
    }
}
