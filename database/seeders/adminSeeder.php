<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'f_name' => 'Elizabeth C',
            'l_name' => 'Kadomole',
            'email' => 'eliza@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
