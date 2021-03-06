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
          'name'     => 'Usuario administrador',
          'email'    => 'admin@email.com',
          'password' => bcrypt('12345'),
          'rol_id'   => 0,
          'latitud'  => '8.284305',
          'longitud'  => '-62.754250',
        ],
        [
          'name'     => 'Salones grandes',
          'email'    => 'salongrande@email.com',
          'password' => bcrypt('12345'),
          'rol_id'   => 1,
          'latitud'  => '8.284305',
          'longitud'  => '-62.754250',
        ],
        [
          'name'     => 'Salones pequeños',
          'email'    => 'salonpequeño@email.com',
          'password' => bcrypt('12345'),
          'rol_id'   => 2,
          'latitud'  => '8.284305',
          'longitud'  => '-62.754250',
        ],
        [
          'name'     => 'Profesional independiente',
          'email'    => 'profesional@email.com',
          'password' => bcrypt('12345'),
          'rol_id'   => 3,
          'latitud'  => '8.284305',
          'longitud'  => '-62.754250',
        ],
        [
          'name'     => 'Usuario cliente',
          'email'    => 'cliente@email.com',
          'password' => bcrypt('12345'),
          'rol_id'   => 4,
          'latitud'  => '8.284305',
          'longitud'  => '-62.754250',
        ],
        [
          'name'     => 'ricardo es independiente',
          'email'    => 'independiente@email.com',
          'password' => bcrypt('12345'),
          'rol_id'   => 3,
          'latitud'  => '8.284305',
          'longitud'  => '-62.754250',
        ],
      ];

      foreach ($datos as $dato) {
				User::create($dato);
      }
    }
}
