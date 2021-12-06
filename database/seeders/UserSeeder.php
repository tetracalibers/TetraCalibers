<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => '',
            'email' => '',
            'email_verified_at' => now(),
            'password' => \Hash::make(''),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
