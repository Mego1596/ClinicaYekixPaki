<?php

use Illuminate\Database\Seeder;
use App\User;
use Caffeinated\Shinobi\Models\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
    	User::create([
    		'name' => 'Administrador',
    		'email'=> 'maurigranados1596@gmail.com',
    		'password' => bcrypt('admin'),
    		'remember_token' => 'qwertyuiop',
    	]);

    	Role::create([
    		'name' 		=> 'Admin',
    		'slug' 		=> 'admin',
    		'special' 	=> 'all-access',
    	]);
    }
}
