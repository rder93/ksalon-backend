<?php

use Illuminate\Database\Seeder;

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
            	            'user_id'		=> 4,
                            'service_id'	=> 1,
                            'precio'		=> 2000
                        ],
                        [
            	            'user_id'		=> 4,
                            'service_id'	=> 3,
                            'precio'		=> 5000
                        ],
                        [
            	            'user_id' 		=> 4,
                            'service_id'	=> 5,
                            'precio'		=> 10000
                        ],
                        [
                            'user_id'		=> 6,
                            'service_id'	=> 3,
                            'precio'		=> 5000
                        ],
                        [
                            'user_id'		=> 6,
                            'service_id'	=> 2,
                            'precio'		=> 10000
                        ]
                    ];

        DB::table('independents_services')->insert($pivots);
    }
}
