<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        	'role_id' => '1',
        	'name' => 'Mr. Admin',
            'username' => 'admin',
        	'phone' => '01960502569',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('123456789'),
        ]);
        DB::table('users')->insert([
        	'role_id' => '2',
        	'name' => 'Mr. Staff',
        	'username' => 'staff',
            'phone' => '01960502579',
        	'email' => 'staff@gmail.com',
        	'password' => bcrypt('123456789'),
        ]);
        DB::table('users')->insert([
        	'role_id' => '3',
        	'name' => 'Mr. Customer',
        	'username' => 'customer',
            'phone' => '01960502589',
        	'email' => 'customer@gmail.com',
        	'password' => bcrypt('123456789'),
        ]);
    }
}
