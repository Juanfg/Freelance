<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'          => 'Juan Pablo Flores',
            'email'         => 'juanfg@outlook.com',
            'password'      => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name'          => 'Jorge Beauregard Bravo',
            'email'         => 'jorgebeauregard@gmail.com',
            'password'      => bcrypt('secret'),
        ]);
    }
}
