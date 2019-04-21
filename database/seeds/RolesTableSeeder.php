<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	[
        		'id' => 1,
        		'role' => 'Super Admin',
        	],
        	[
        		'id' => 2,
        		'role' => 'User'
        	],
        ]);
    }
}
