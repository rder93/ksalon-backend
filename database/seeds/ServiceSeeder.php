<?php

use Illuminate\Database\Seeder;

use App\Models\Service;

class ServiceSeeder extends Seeder
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
        		'nombre' 	=> 'Corte de cabello'
        	],
            [
                'nombre'    => 'Secado de cabello'
            ],
            [
                'nombre'    => 'Manicura'
            ],
            [
                'nombre'    => 'Maquillaje'
            ],
            [
                'nombre'    => 'Pedicura'
            ]

        ];

        foreach ($datos as $dato) {
			Service::create($dato);
        }
    }
}
