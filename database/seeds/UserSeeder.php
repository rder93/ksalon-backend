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
					'name'     => 'Usuario cliente',
					'email'    => 'cliente@email.com',
					'password' => bcrypt('12345'),
					'rol_id'   => 5
				]
      ];

      foreach ($datos as $dato) {
				User::create($dato);
      }
    }
}
