<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Paciente;
use App\Events;
use App\Plan_Tratamiento;

class PacienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paciente::create([

        	'nombre1'			=> 'Paciente',
        	'apellido1'			=> 'Reservado',
        	'fechaNacimiento'	=> '2018/01/01',
        	'ocupacion'			=> 'Agendar Usuarios Nuevos',
        	'telefono'			=> '0000-0000',
        	'habilitado'		=>  true,
        	'sexo'				=> 'I',
        	'domicilio'			=> 'Col.Libertad Av.Washington #414, San Salvador',
        	'expediente'		=> 'XXXX-XX',
        	]);
        Events::create([
            'start_date'        => '1900-01-01 00:00:00',
            'end_date'          => '1900-01-01 00:30:00',
            'textcolor'         => '#FFFFFF',
            'descripcion'       => 'cita por defecto',
            'paciente_id'       => 1,
            ]);
        Plan_Tratamiento::create([
            'procedimiento_id'  => 1,
            'events_id'         => 1,
            'no_de_piezas'      => 0,
            'honorarios'        => 0,
            'activo'            => true,
            'completo'          => true,
            'en_proceso'        => false,
            'no_iniciado'       => false,
            ]);
    }
}
