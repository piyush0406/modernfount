<?php

use Illuminate\Database\Seeder;

class WriterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $password = bcrypt('1234');
         DB::table('users')->insert([
            'name' => 'writer',
            'role' => 2,
            'email' => 'writer@contree.in',
            'password' => $password,
        ]);
    }
}
