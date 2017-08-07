<?php

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
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
        		'nombre' 	=> 'Gran Salon',
        	],
            [
                'nombre'    => 'Salon',
            ],
            [
                'nombre'    => 'Profesional independiente',
            ]
        ];

        foreach ($datos as $dato) {
			Category::create($dato);        	
        }
    }
}
