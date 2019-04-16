<?php

use Illuminate\Database\Seeder;
use App\Area;
class AreasTableSeeder extends Seeder
{
    public function run()
    {
        $areas = [
        	'ÁREA DE INGENIERÍA AGRONÓMICA',
        	'ÁREA DE CIENCIAS DE LA SALUD',
        	'ÁREA DE ODONTOLOGÍA',
        	'ÁREA DE CIENCIAS DE LA EDUCACIÓN',
        	'ÁREA DE CS. ECONÓMICAS Y SOCIALES',
        	'ÁREA DE INGENIERÍA EN SISTEMAS',
        	'ÁREA DE ARQUITECTURA Y TECNOLOGÍA',
        	'ÁREA DE CS. POLÍTICAS Y JURÍDICAS',
        	'ÁREA DE HUMANIDADES, LETRAS Y ARTES',
        	'ÁREA DE CIENCIAS VETERINARIAS',
        ];

        foreach ($areas as $key => $value) {
        	$area = Area::create([
        		'name'	=>	$value,
        	]);
        }
    }
}
