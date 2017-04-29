<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'name'          => 'Project 1',
            'owner'         => 1,
            'description'   => 'This is the description for project 1',
            'location'      => 'Puebla',
            'difficulty'    => 10,
            'document'      => 'Ok'   
        ]);

        DB::table('projects')->insert([
            'name'          => 'Project 2',
            'owner'         => 1,
            'description'   => 'This is the description for project 2',
            'location'      => 'Puebla',
            'difficulty'    => 5,
            'document'      => 'Ok'   
        ]);

        DB::table('projects')->insert([
            'name'          => 'Project 3',
            'owner'         => 1,
            'description'   => 'This is the description for project 3',
            'location'      => 'Puebla',
            'difficulty'    => 2,
            'document'      => 'Ok'   
        ]);
    }
}
