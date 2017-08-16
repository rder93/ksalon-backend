<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('username',100)->unique()->nullable();
            $table->string('avatar')->nullable()->default('no_avatar.jpg');
            $table->string('email',150)->unique();
            $table->string('password');
            $table->integer('status')->nullable();
            $table->string('dni')->nullable();             // Numero de identificacion
            $table->string('paypal',150)->unique()->nullable(); // Cuenta paypal del usuario (Solo visible para el admin)

            $table->string('latitud');
            $table->string('altitud');
            $table->integer('rol_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            // $table->foreign('rol_id')->references('id')->on('rols');
                // ->onUpdate('cascade')
                // ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
