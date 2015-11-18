<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubigeo', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code',10)->unique();
            $table->string('name',100);
            $table->string('department',100)->nullable();
            $table->string('province',100)->nullable();
            $table->string('district',100)->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('especialidad', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code',10)->unique();
            $table->string('name',100)->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('paciente', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('farmacia_id')->nullable()->unsigned();
            $table->integer('ubigeo_id')->unsigned();
            $table->string('dni',10)->unique();
            $table->string('name',200);
            $table->string('sexo',1)->default('M');
            $table->string('edad',2)->nullable();
            $table->string('direccion',200)->nullable();
            $table->string('telefono',12)->nullable();
            $table->string('correo',100)->nullable();
            $table->boolean('nuevo')->default(true);
            $table->boolean('receta')->default(true);
            $table->string('description')->nullable();

            $table->foreign('ubigeo_id')->references('id')->on('ubigeo');
            $table->foreign('farmacia_id')->references('id')->on('farmacia');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('medico', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('farmacia_id')->nullable()->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->string('cmp',10)->unique();
            $table->string('name',200);
            $table->boolean('nuevo')->default(true);
            $table->string('description')->nullable();

            $table->foreign('especialidad_id')->references('id')->on('especialidad');
            $table->foreign('farmacia_id')->references('id')->on('farmacia');
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
        Schema::drop('paciente');
        Schema::drop('medico');
        Schema::drop('especialidad');
        Schema::drop('ubigeo');
    }
}
