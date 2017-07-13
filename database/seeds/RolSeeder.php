<?php

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
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
        		'nombre' 	=> 'admin',
        		'nivel'		=> '0'
        	],
            [
                'nombre'    => 'Salones grandes',
                'nivel'     => '1'
            ],
            [
                'nombre'    => 'Salones pequeños',
                'nivel'     => '2'
            ],
            [
                'nombre'    => 'Profesional independiente',
                'nivel'     => '3'
            ],
            [
                'nombre'    => 'Cliente',
                'nivel'     => '4'
            ]

        ];

        foreach ($datos as $dato) {
			Rol::create($dato);        	
        }
    }
}
