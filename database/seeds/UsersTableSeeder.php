<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

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
        	[
        		'id' => 1,
        		'name' => 'Super Admin',
        		'email' => 'sadmin@admin.com',
        		'role_id' => 1,
        		'password' => Hash::make('admin'),
                'created_at' => Carbon::now()->toDateTimeString(),
        	],
        	[
        		'id' => 2,
        		'name' => 'Simple User',
        		'email' => 'user@admin.com',
        		'role_id' => 2,
        		'password' => Hash::make('user'),
                'created_at' => Carbon::now()->toDateTimeString(),
        	],
        ]);
    }
}
