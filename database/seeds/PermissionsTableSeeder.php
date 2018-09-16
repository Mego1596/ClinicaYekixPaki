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
        	'description' => 'Eliminar cualquier dato de un usuario del sistema',
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
        	'description' => 'Eliminar cualquier dato de un rol del sistema',
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
        	'description' => 'Eliminar cualquier dato de un Procedimiento del sistema',
        ]);


    //Pacientes
        Permission::create([
            'name' => 'Navegar Pacientes',
            'slug' => 'pacientes.index',
            'description' => 'Lista y Navega todos los Pacientes del Sistema',
        ]);

        Permission::create([
            'name' => 'Ver Detalle de Paciente',
            'slug' => 'pacientes.show',
            'description' => 'Ver en detalle cada Paciente del sistema',
        ]);

        Permission::create([
            'name' => 'Creacion de Pacientes',
            'slug' => 'pacientes.create',
            'description' => 'Editar cualquier dato de un Paciente del sistema',
        ]);

        Permission::create([
            'name' => 'Edicion de Pacientes',
            'slug' => 'pacientes.edit',
            'description' => 'Editar cualquier dato de un Paciente del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar Paciente',
            'slug' => 'pacientes.destroy',
            'description' => 'Eliminar cualquier dato de un Paciente del sistema',
        ]);

        Permission::create([
            'name' => 'Calendario de Citas del Paciente',
            'slug' => 'pacientes.citas',
            'description' => 'Lista y Navega todos los Pacientes del Sistema',
        ]);

        //Permisos a Terceros
        Permission::create([
            'name' => 'Calendario de Trabajo',
            'slug' => 'pacientes.trabajo',
            'description' => 'Navega la vista del Calendario de Trabajo',
        ]);

        Permission::create([
            'name' => 'Historia Odontologica',
            'slug' => 'admin.historiaO',
            'description' => 'Activacion de campo Historia Odontologica para Pacientes'
            ]);

        Permission::create([
            'name' => 'Historia Medica',
            'slug' => 'admin.historiaM',
            'description' => 'Activacion de campo Historia Medica para Pacientes'
            ]);

        Permission::create([
            'name' => 'Crear Historia Medica',
            'slug' => 'admin.crearHistoria',
            'description' => 'Activacion de boton crear Historia para Pacientes',
        ]);

        Permission::create([
            'name' => 'Editar Historia Medica',
            'slug' => 'admin.editarHistoria',
            'description' => 'Activacion de boton editar Historia para Pacientes'
            ]);

        Permission::create([
            'name' => 'Eliminar Historia Medica',
            'slug' => 'admin.eliminarHistoria',
            'description' => 'Activacion de campo eliminar Historia Medica para Pacientes'
            ]);

        Permission::create([
            'name' => 'Revocar Permiso',
            'slug' => 'admin.revoke',
            'description' => 'Habilitar Eliminar Grupo de Privilegios al usuario'
            ]);
        
        //Plan de Tratamiento
        Permission::create([
            'name' => 'Navegar Planes de Tratamiento',
            'slug' => 'planTratamientos.index',
            'description' => 'Lista y Navega todos los Planes de Tratamiento del Sistema',
        ]);

        Permission::create([
            'name' => 'Ver Detalle de Plan de Tratamiento',
            'slug' => 'planTratamientos.show',
            'description' => 'Ver en detalle cada Plan de Tratamiento del sistema',
        ]);

        Permission::create([
            'name' => 'Creacion de Planes de Tratamiento',
            'slug' => 'planTratamientos.create',
            'description' => 'Editar cualquier dato de un Plan de Tratamiento del sistema',
        ]);

        Permission::create([
            'name' => 'Edicion de Planes de Tratamiento',
            'slug' => 'planTratamientos.edit',
            'description' => 'Editar cualquier dato de un Plan de Tratamiento del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar Plan de Tratamiento',
            'slug' => 'planTratamientos.destroy',
            'description' => 'Eliminar cualquier dato de un Plan de Tratamiento del sistema',
        ]);


        //Recetas
        Permission::create([
            'name' => 'Navegar Recetas',
            'slug' => 'recetas.index',
            'description' => 'Lista y Navega todos los Recetas del Sistema',
        ]);

        Permission::create([
            'name' => 'Ver Detalle de Receta',
            'slug' => 'recetas.show',
            'description' => 'Ver en detalle cada Receta del sistema',
        ]);

        Permission::create([
            'name' => 'Creacion de Recetas',
            'slug' => 'recetas.create',
            'description' => 'Editar cualquier dato de un Receta del sistema',
        ]);

        Permission::create([
            'name' => 'Edicion de Recetas',
            'slug' => 'recetas.edit',
            'description' => 'Editar cualquier dato de un Receta del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar Recetas',
            'slug' => 'recetas.destroy',
            'description' => 'Eliminar cualquier dato de un Receta del sistema',
        ]);


        //Detalle Receta
        Permission::create([
            'name' => 'Navegar Detalle Recetas',
            'slug' => 'detalleRecetas.index',
            'description' => 'Lista y Navega todos los Detalles Recetas de la Receta',
        ]);

        Permission::create([
            'name' => 'Ver Detalle de Receta',
            'slug' => 'detalleRecetas.show',
            'description' => 'Ver en detalle cada Detalle de Receta de la receta',
        ]);

        Permission::create([
            'name' => 'Creacion de Detalle Recetas',
            'slug' => 'detalleRecetas.create',
            'description' => 'Editar cualquier dato de un Detalle de Receta de la receta',
        ]);

        Permission::create([
            'name' => 'Edicion de Detalle Recetas',
            'slug' => 'detalleRecetas.edit',
            'description' => 'Editar cualquier dato de un Detalle de Receta de la receta',
        ]);

        Permission::create([
            'name' => 'Eliminar Detalle Receta',
            'slug' => 'detalleRecetas.destroy',
            'description' => 'Eliminar cualquier dato de un Detalle de Receta de la receta',
        ]);

        Permission::create([
            'name' => 'Habilitar Paciente',
            'slug' => 'pacientes.habilitarPaciente',
            'description' => 'Campo habilitar pacientes que estan deshabilitados',
        ]);
    }
}
