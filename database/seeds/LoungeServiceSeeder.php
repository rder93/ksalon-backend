<?php

use Illuminate\Database\Seeder;

class LoungeServiceSeeder extends Seeder
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
                            'lounge_id'     => 1,
                            'service_id'    => 4,
                            'precio'        => 32,
                            'descripcion'   => "Esta es la descripcion del servicio de un personal del salon en la aplicacion de ksalonaso.",
                            'foto'          => 'Jr4rUp-Guardians of the Galaxy Vol. 2.jpg'
                        ],
                        [
                            'lounge_id'     => 1,
                            'service_id'    => 1,
                            'precio'        => 23,
                            'descripcion'   => "Esta es la descripcion del servicio de un personal del salon en la aplicacion de ksalonaso.",
                            'foto'          => 'BG93kD-DimensionPeliculas.com.jpg'
                        ],
                        [
                            'lounge_id'     => 1,
                            'service_id'    => 5,
                            'precio'        => 321,
                            'descripcion'   => "Esta es la descripcion del servicio de un personal del salon en la aplicacion de ksalonaso.",
                            'foto'          => 'U70ffR-Icono.ico'
                        ],
                        [
                            'lounge_id'     => 3,
                            'service_id'    => 2,
                            'precio'        => 654,
                            'descripcion'   => "Esta es la descripcion del servicio de un personal del salon en la aplicacion de ksalonaso.",
                            'foto'          => 'LByK6r-DimensionPeliculas.com.jpg'
                        ],
                        [
                            'lounge_id'     => 3,
                            'service_id'    => 5,
                            'precio'        => 895,
                            'descripcion'   => "Esta es la descripcion del servicio de un personal del salon en la aplicacion de ksalonaso.",
                            'foto'          => 'jrkUhA-Guardians of the Galaxy Vol. 2.jpg'
                        ],

                    ];

        DB::table('lounges_services')->insert($pivots);
    }
}
