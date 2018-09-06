<?php

use Illuminate\Database\Seeder;
use App\Procedimiento;

class ProcedimientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Procedimientos
    	Procedimiento::create([
    		'nombre' => 'Obturaciones Esteticas (Rellenos)',
    		'descripcion' => 'Limpiar la cavidad resultante de una caries para luego rellenarla con algún material.',
    		'color' => '#006600',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Endodoncia',
    		'descripcion' => 'Extirpacion de la pulpa dental y el posterior relleno y sellado de la cavidad pulpar con un material inerte.',
    		'color' => '#00cc00',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Guardas Oclusales',
    		'descripcion' => 'Consiste en un aparato bucal de plastico que se coloca en una de las arcadas dentarias para evitar que entren en contacto unos dientes con otros, para llevar la mandibula a una posicion articularmente adecuada cuando se muerde sobre ella, bien para "olvidar" las posiciones mandibulares inadecuadas e incorrectas de los dientes cuando se mantienen apretados, o bien para evitar el desgaste de los dientes (bruxismo), ya que el plastico de la placa es mas blando y desgastable que estos.',
    		'color' => '#000099',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Protesis Parciales Fijas',
    		'descripcion' => 'Protesis completamente dentosoportadas, que toman apoyo unicamente en los dientes.',
    		'color' => '#0066ff',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Protesis Removibles Parciales y Totales',
    		'descripcion' => 'Tratamiento de Odontologia restauradora que, como su propio nombre indica, se diseñan y fabrican de modo que el paciente pueda colocarsela y quitarsela cuando lo necesite, lo que facilita enormemente su higiene.',
    		'color' => '#660066',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Profilaxis y Destartrajes con Ultrasonido (limpiezas)',
    		'descripcion' => 'desprender el tártaro (llamado también SARRO) que esta pegado a los dientes. Se hace al principio con un equipo de ultrasonido diente por diente.',
    		'color' => '#cc33ff',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Exodoncia',
    		'descripcion' => 'Acto quirurgico mediante el cual se extraen los dientes de sus alveolos con el menor trauma posible.',
    		'color' => '#663300',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Cirujia de Cordales',
    		'descripcion' => 'se realiza en los casos en los que dan sintomatologia (dolor grave o agudo, infecciones de repeticion, caries en los segundos molares por mala higiene, etc.) o se encuentra algun signo radiologico patologico (algun quiste o erosión de raices de otras piezas).',
    		'color' => '#996600',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Pulpotomias y Pulpectomias',
    		'descripcion' => 'Pulpotomia: Se realiza en dientes temporales, y consiste en eliminar parte de la pulpa del diente. Para realizarla se elimina una parte de la pulpa dental y se coloca un material que servira para favorecer la cicatrizacion y asi conservar la vitalidad pulpar radicular. Esta indicada en exposicion pulpar cariosa a traumatismo en un diente asintomatico y en caries que clinica y radiologicamente se acerca a la pulpa. Pulpectomia. Es la eliminacion total de la pulpa de la camara coronaria asi como la pulpa radicular para luego rellenar los conductos con oxido de zinc eugenol. Es importante que el relleno, en este caso el oxido de zinc eugenol, sea reabsorbible para que no haya problemas cuando el diente permenante empiece la erupcion. Esta indicada en aquellos casos que se quiera conservar el diente por razones de mantenimiento de espacio en las que no sea factible poner un mantenedor de espacio y tengamos la pulpa radicular afectada',
    		'color' => '#4d4d33',
    	]);

    	Procedimiento::create([
    		'nombre' => 'Otras',
    		'descripcion' => 'No Disponible',
    		'color' => '#999966',
    	]);
    }
}
