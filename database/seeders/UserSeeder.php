<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected static ?string $password;
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => static::$password ??= Hash::make('label@45758&&'),
            ],
            [
                'name' => 'yesikaoktavilenda97',
                'email' => 'yesikaoktavilenda97@gmail.com',
                'role' => 'user',
                'password' => static::$password ??= Hash::make('label@45758&&'),
            ],
        ]);
    }
}
