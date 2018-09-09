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

        User::create([
        	'nombre1'			=> 'Mauricio',
        	'nombre2'			=> 'Ernesto',
     		'apellido1'			=> 'Granados',
     		'apellido2'			=> 'Orellana',
        	'email'				=> 'go14002@ues.edu.sv',
        	'name'				=> 'MG001-18',
        	'password'			=> '1',
        ]);

        Paciente::create([
        	'nombre1'			=> 'Mauricio',
        	'nombre2'			=> 'Ernesto',
     		'apellido1'			=> 'Granados',
     		'apellido2'			=> 'Orellana',
     		'fechaNacimiento'	=> '1996-01-05',
     		'email'				=> 'go14002@ues.edu.sv',
     		'telefono'			=> '7928-5167',
     		'ocupacion'			=> 'Estudiante',
     		'sexo'				=> 'M',
     		'domicilio'			=> 'Col Libertad Pje Venezuela #13',
     		'expediente'		=> 'G001-18',
     		'user_id'			=> '2',
        ]);

    }
}
