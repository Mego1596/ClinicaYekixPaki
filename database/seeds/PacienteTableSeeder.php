<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Paciente;

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
    }
}
