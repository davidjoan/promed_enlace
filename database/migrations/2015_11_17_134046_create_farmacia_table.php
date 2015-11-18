<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmaciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmacia', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tipo_farmacia_id')->unsigned();
            $table->string('code',10)->unique();
            $table->string('ruc',12)->unique();
            $table->string('name',200);
            $table->string('description')->nullable();
            $table->foreign('tipo_farmacia_id')->references('id')->on('tipo_farmacia');
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
        Schema::drop('farmacia');
    }
}
