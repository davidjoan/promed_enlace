<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('linea_id')->unsigned();
            $table->integer('familia_id')->unsigned();
            $table->string('code',10)->unique();
            $table->string('name',200);
            $table->string('description')->nullable();
            $table->integer('cantidad')->unsigned();
            $table->integer('bonificacion')->unsigned();
            $table->foreign('linea_id')->references('id')->on('linea');
            $table->foreign('familia_id')->references('id')->on('familia');
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
        Schema::drop('producto');
    }
}
