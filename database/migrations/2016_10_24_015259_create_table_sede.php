<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSede extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
   {       
        Schema::create('SEDES', function (Blueprint $table) {

            $table->increments('id');
            $table->string('descripcion', 300);
            $table->string('direccion', 300);
            $table->string('observaciones', 300);
            $table->integer('id_responsable')->unsigned();

            $table->foreign('id_responsable')
                  ->references('USER_id')->on('USERS')
                  ->onDelete('cascade');


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
        //
        Schema::drop('SEDES');
    }
}
