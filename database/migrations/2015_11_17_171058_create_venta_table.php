<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('medico_id')->unsigned();
            $table->integer('paciente_id')->unsigned();
            $table->integer('periodo_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->dateTime('fecha')->nullable();
            $table->string('codigo',20)->unique();
            $table->integer('cantidad')->unsigned();
            $table->integer('bonificacion')->unsigned();
            $table->integer('fraccion')->unsigned();
            $table->string('description')->nullable();
            $table->boolean('receta')->default(true);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('medico_id')->references('id')->on('medico');
            $table->foreign('paciente_id')->references('id')->on('paciente');
            $table->foreign('periodo_id')->references('id')->on('periodo');
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->softDeletes();
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
        Schema::drop('venta');
    }
}
