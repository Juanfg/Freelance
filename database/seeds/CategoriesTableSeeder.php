<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Science',
        ]);

        DB::table('categories')->insert([
            'name' => 'Sports',
        ]);

        DB::table('categories')->insert([
            'name' => 'Computer Science',
        ]);

        DB::table('categories')->insert([
            'name' => 'Fun stuff',
        ]);

        DB::table('categories')->insert([
            'name' => 'Just another proyect about dogs',
        ]);

        DB::table('categories')->insert([
            'name' => 'Quality Software',
        ]);

        DB::table('categories')->insert([
            'name' => 'Geography',
        ]);

        DB::table('categories')->insert([
            'name' => 'Music',
        ]);

        DB::table('categories')->insert([
            'name' => 'Architecture',
        ]);
    }
}
