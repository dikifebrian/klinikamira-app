<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'Manajer',
            'level' => 'manajer',
            'email' => 'manajer@amira.com',
            'password' => bcrypt('manajer'),
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'Kasir',
            'level' => 'kasir',
            'email' => 'kasir@amira.com',
            'password' => bcrypt('kasir'),
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'Dokter',
            'level' => 'dokter',
            'email' => 'dokter@amira.com',
            'password' => bcrypt('dokter'),
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'Terapis',
            'level' => 'terapis',
            'email' => 'terapis@amira.com',
            'password' => bcrypt('terapis'),
            'remember_token' => Str::random(60),
        ]);
    }
}
