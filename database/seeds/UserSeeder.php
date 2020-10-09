<?php

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
        $password = Hash::make('1234');
         DB::table('users')->insert([
            'name' => 'admin',
            'role' => 1,
            'email' => 'admin@contree.in',
            'password' => $password,
        ]);
    }
}
