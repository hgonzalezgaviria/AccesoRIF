<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesosTable extends Migration
{
    
    private $nomTabla = 'ACCESOS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = $this->nomTabla.': ';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {

            $table->increments('ACCE_ID');
            $table->unsignedInteger('PROP_ID');
            $table->unsignedInteger('TARJ_ID');
            $table->dateTime('ACCE_FECHAENTRADA');
            $table->dateTime('ACCE_FECHASALIDA')->nullable();
            $table->unsignedInteger('ACCE_TIPOACCESO');
            $table->string('ACCE_ESTADO');
            
            //Traza
            $table->string('ACCE_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('ACCE_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('ACCE_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('ACCE_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('ACCE_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('ACCE_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');


            //Relaciones
            $table->foreign('PROP_ID')
            ->references('PROP_ID')
            ->on('PROPIETARIOS')
            ->onDelete('cascade');
            //Relaciones
            $table->foreign('TARJ_ID')
            ->references('TARJ_ID')
            ->on('TARJETAS')
            ->onDelete('cascade');

        });


        
        if(env('DB_CONNECTION') == 'pgsql')
            DB::statement("COMMENT ON TABLE ".env('DB_SCHEMA').".\"".$this->nomTabla."\" IS '".$commentTabla."'");
        elseif(env('DB_CONNECTION') == 'mysql')
            DB::statement("ALTER TABLE ".$this->nomTabla." COMMENT = '".$commentTabla."'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo '- Borrando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::dropIfExists($this->nomTabla);
    }

}
