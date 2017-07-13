<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
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
					'name'     => 'ejemplo prueba',
					'email'    => 'email@email.com',
					'password' => bcrypt('1024456'),
					'rol_id'   => 4
				]
      ];

      foreach ($datos as $dato) {
				User::create($dato);
      }
    }
}
