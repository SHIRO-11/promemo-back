<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        DB::table('users')->insert([
            [
            'name' => 'テスト',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testpromemo'), // password
            'remember_token' => Str::random(10),
            ],
            [
            'name' => 'テスト2',
            'email' => 'test2@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testpromemo2'), // password
            'remember_token' => Str::random(10),
            ]
        ]);

        \App\Models\User::factory(10)->create();
    }
}