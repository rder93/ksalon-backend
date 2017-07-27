<?php

use Illuminate\Database\Seeder;
use App\Models\Independent;

class IndependentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	$pivots  = [
                        [
            	            'independent_id' 	=> 1,
                            'service_id'        => 1,
                            'precio'            => 2000
                        ],
                        [
            	            'independent_id' 	=> 1,
                            'service_id' 		=> 3,
                            'precio'            => 5000
                        ],
                        [
            	            'independent_id' 	=> 1,
                            'service_id' 		=> 5,
                            'precio'            => 10000
                        ],
                        [
                            'independent_id'    => 2,
                            'service_id'        => 3,
                            'precio'            => 5000
                        ],
                        [
                            'independent_id'    => 2,
                            'service_id'        => 5,
                            'precio'            => 10000
                        ]
                    ];

        DB::table('independents_services')->insert($pivots);
    }
}
