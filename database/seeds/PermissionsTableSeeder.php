<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
        	'name' => 'Navegar usuarios',
        	'slug' => 'users.index',
        	'description' => 'Lista y Navega todos los usuarios del Sistema',
        ]);

        Permission::create([
        	'name' => 'Ver Detalle de usuarios',
        	'slug' => 'users.show',
        	'description' => 'Ver en detalle cada usuario del sistema',
        ]);

        Permission::create([
        	'name' => 'Creacion de usuarios',
        	'slug' => 'users.create',
        	'description' => 'Editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
        	'name' => 'Edicion de usuarios',
        	'slug' => 'users.edit',
        	'description' => 'Editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
        	'name' => 'Eliminar usuarios',
        	'slug' => 'users.destroy',
        	'description' => 'Eeliminar cualquier dato de un usuario del sistema',
        ]);







        //Roles
        Permission::create([
        	'name' => 'Navegar roles',
        	'slug' => 'roles.index',
        	'description' => 'Lista y Navega todos los roles del Sistema',
        ]);

        Permission::create([
        	'name' => 'Ver Detalle de rol',
        	'slug' => 'roles.show',
        	'description' => 'Ver en detalle cada rol del sistema',
        ]);

        Permission::create([
        	'name' => 'Creacion de roles',
        	'slug' => 'roles.create',
        	'description' => 'Editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
        	'name' => 'Edicion de roles',
        	'slug' => 'roles.edit',
        	'description' => 'Editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
        	'name' => 'Eliminar rol',
        	'slug' => 'roles.destroy',
        	'description' => 'Eeliminar cualquier dato de un rol del sistema',
        ]);













        //Procedimientos
        Permission::create([
        	'name' => 'Navegar Procedimientos',
        	'slug' => 'procedimientos.index',
        	'description' => 'Lista y Navega todos los Procedimientos del Sistema',
        ]);

        Permission::create([
        	'name' => 'Ver Detalle de Procedimiento',
        	'slug' => 'procedimientos.show',
        	'description' => 'Ver en detalle cada Procedimiento del sistema',
        ]);

        Permission::create([
        	'name' => 'Creacion de Procedimientos',
        	'slug' => 'procedimientos.create',
        	'description' => 'Editar cualquier dato de un Procedimiento del sistema',
        ]);

        Permission::create([
        	'name' => 'Edicion de Procedimientos',
        	'slug' => 'procedimientos.edit',
        	'description' => 'Editar cualquier dato de un Procedimiento del sistema',
        ]);

        Permission::create([
        	'name' => 'Eliminar Procedimiento',
        	'slug' => 'procedimientos.destroy',
        	'description' => 'Eeliminar cualquier dato de un Procedimiento del sistema',
        ]);


    }
}
