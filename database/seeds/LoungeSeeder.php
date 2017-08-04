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
                // 'descripcion'    => 'aqui va la descripcion',
                'latitud'     => '8.281954',
                'altitud'    => '-62.758308',
                'user_id'     => '1',
                'category_id' => '1'
            ],
            [
                'nombre'      => 'Peluqueria 2',
                // 'descripcion'    => 'aqui va la descripcion',
                'latitud'     => '8.286307',
                'altitud'    => '-62.753952',
                'user_id'     => '1',
                'category_id' => '1'
            ],
            [
                'nombre'      => 'Peluqueria 3',
                // 'descripcion'    => 'aqui va la descripcion',
                'latitud'     => '8.277822',
                'altitud'    => '-62.756134',
                'user_id'     => '1',
                'category_id' => '1'
            ],
            [
                'nombre'      => 'Peluqueria 4',
                // 'descripcion'    => 'aqui va la descripcion',
                'latitud'     => '8.279181',
                'altitud'    => '-62.750266',
                'user_id'     => '1',
                'category_id' => '1'
            ],

        ];

        foreach ($datos as $dato) {
			Lounge::create($dato);        	
        }
    }
}
