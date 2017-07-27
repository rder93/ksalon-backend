<?php

use Illuminate\Database\Seeder;
use App\Models\Independent;

class IndependentSeeder extends Seeder
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
        		'user_id' 	=> 4,
        	],
            [
                'user_id'   => 6,
            ]
        ];

        foreach ($datos as $dato) {
			Independent::create($dato);        	
        }    }
}
