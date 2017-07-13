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
        		'nombre' 	=> 'Salones Grandes',
        	],
            [
                'nombre'    => 'Salones',
            ],
            [
                'nombre'    => 'Independientes',
            ]
        ];

        foreach ($datos as $dato) {
			Category::create($dato);        	
        }
    }
}
