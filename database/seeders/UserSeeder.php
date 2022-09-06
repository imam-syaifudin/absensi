<?php

namespace Database\Seeders;


use Illuminate\Support\Str;
use App\Models\User;
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
        //
        User::truncate();
        User::create([
            'pengaturan_id' => 1,
            'name' => 'Admin',
            'nip' => 1234567,
            'level' => 'admin',
            'password' => bcrypt('20042005'),
            'remember_token' => Str::random(60),
        ]);
    } 
}
