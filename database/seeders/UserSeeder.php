<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Yuli',
            'username' => 'yuli',
            'email' => 'yuli@mail.com',
            'password' => Hash::make('123'),
            'foto' => null,
            'no_hp' => '+6282655678661',
            'alamat' => 'Jl. Apel Manis No. 201'
        ])->assignRole(['admin', 'user']);
    }
}
