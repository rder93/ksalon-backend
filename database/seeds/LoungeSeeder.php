<?php

use Illuminate\Database\Seeder;
use App\Models\Lounge;

class LoungeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos = [
        	[
                'nombre'      => 'Peluqueria 1',
                'descripcion'    => 'aqui va la descripcion',
                'latitud'    => '-62.758308',
                'longitud'     => '8.281954',
                'user_id'     => '1',
                'category_id' => '1'
            ],
            [
                'nombre'      => 'Peluqueria 2',
                'descripcion'    => 'aqui va la descripcion',
                'latitud'    => '-61.758308',
                'longitud'     => '8.281954',
                'user_id'     => '1',
                'category_id' => '1'
            ],
            [
                'nombre'      => 'Peluqueria 3',
                'descripcion'    => 'aqui va la descripcion',
                'latitud'    => '-60.758308',
                'longitud'     => '8.281954',
                'user_id'     => '1',
                'category_id' => '1'
            ],
            [
                'nombre'      => 'Peluqueria 4',
                'descripcion'    => 'aqui va la descripcion',
                'latitud'    => '-69.758308',
                'longitud'     => '8.281954',
                'user_id'     => '1',
                'category_id' => '1'
            ],

        ];

        foreach ($datos as $dato) {
			Lounge::create($dato);        	
        }
    }
}
