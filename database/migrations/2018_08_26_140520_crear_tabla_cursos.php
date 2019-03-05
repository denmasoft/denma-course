<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('lugar_celebracion', 255);
            $table->date('fecha_inicio', 40);
            $table->date('fecha_fin', 40);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('duracion_horas');
            $table->integer('plazas_total');
            $table->integer('plazas_disponibles');
            $table->string('edades_recomendadas');
            $table->boolean('pertenece_fie');
            $table->string('contenido', 255);
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
        Schema::dropIfExists('cursos');
    }
}
