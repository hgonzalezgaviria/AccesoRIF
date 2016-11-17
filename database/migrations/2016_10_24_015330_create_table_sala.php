<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSala extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
   Schema::create('SALAS', function (Blueprint $table) {

            $table->increments('id');
            $table->string('descripcion', 300);
            $table->integer('capacidad');
            $table->string('fotosala', 500);
            $table->string('fotocroquis', 500);
            $table->string('observaciones', 300);
            $table->integer('ES_ID')->unsigned();
            $table->integer('id_sede')->unsigned(); 

            $table->foreign('ES_ID')
                  ->references('ES_ID')->on('ESTADOS')
                  ->onDelete('cascade');


            $table->foreign('id_sede')
                  ->references('id')->on('SEDES')
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
        Schema::drop('SALAS');
    }
}
