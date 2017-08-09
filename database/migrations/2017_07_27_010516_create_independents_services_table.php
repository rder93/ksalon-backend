<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndependentsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('independents_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('service_id');
            $table->double('precio');
            $table->string('descripcion');
            $table->string('foto')->nullable()->default('no_photo.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('independents_services');
    }
}
