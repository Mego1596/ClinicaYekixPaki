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
    		'name' 		     => 'Administrador',
    		'slug' 		     => 'admin',
            'description'    => 'Rol de Administrador',
    		'special' 	     => 'all-access',
    	]);
        Role::create([
            'name'           => 'Dentista',
            'slug'           => 'doctor',
            'description'    => 'Rol de Dentista',
        ]);
        Role::create([
            'name'           => 'Asistente',
            'slug'           => 'asistente',
            'description'    => 'Rol de Asistente',
        ]);

        Role::create([
            'name'           => 'Suspendido',
            'slug'           => 'suspendido',
            'description'    => 'Rol de Suspendido',
        ]);

        DB::table('role_user')->insert(['role_id' => '1','user_id'=>'1']);

        //Permisos de Dentista
        DB::table('permission_role')->insert(['permission_id' => '1' ,  'role_id'=>'2']);
        DB::table('permission_role')->insert(['permission_id' => '2' ,  'role_id'=>'2']);
        DB::table('permission_role')->insert(['permission_id' => '11' , 'role_id'=>'2']);
        DB::table('permission_role')->insert(['permission_id' => '12' , 'role_id'=>'2']);
        DB::table('permission_role')->insert(['permission_id' => '16' , 'role_id'=>'2']);
        DB::table('permission_role')->insert(['permission_id' => '17' , 'role_id'=>'2']);

        //Permisos Asistente
        DB::table('permission_role')->insert(['permission_id' => '11' , 'role_id'=>'3']);
        DB::table('permission_role')->insert(['permission_id' => '12' , 'role_id'=>'3']);
        DB::table('permission_role')->insert(['permission_id' => '13' , 'role_id'=>'3']);
        DB::table('permission_role')->insert(['permission_id' => '14' , 'role_id'=>'3']);
        DB::table('permission_role')->insert(['permission_id' => '16' , 'role_id'=>'3']);
        DB::table('permission_role')->insert(['permission_id' => '17' , 'role_id'=>'3']);
        DB::table('permission_role')->insert(['permission_id' => '18' , 'role_id'=>'3']);
        DB::table('permission_role')->insert(['permission_id' => '19' , 'role_id'=>'3']);
        DB::table('permission_role')->insert(['permission_id' => '21' , 'role_id'=>'3']);

    }
}
