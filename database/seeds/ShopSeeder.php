<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
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
        		'nombre' 	=> 'Marco Tulio',
        	],
            [
                'nombre'    => 'Juan José',
            ],
            [
                'nombre'    => 'Divas',
            ]
        ];

        foreach ($datos as $dato) {
			Shop::create($dato);        	
        }
    }
}
