<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::create([
            'name' => $faker->name,
            'email' => 'user@shopping.com',
            'password' => bcrypt('password'),
            'roles' => json_encode(['user']),
        ]);

        User::create([
            'name' => $faker->name,
            'email' => 'admin@shopping.com',
            'password' => bcrypt('password-admin'),
            'roles' => json_encode(['admin']),
        ]);
    }
}
