<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarjetasTable extends Migration
{
    
    private $nomTabla = 'TARJETAS';

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

            $table->increments('TARJ_ID');          
            $table->unsignedInteger('PROP_ID');
            $table->string('TARJ_IDTAG', 300)->comment('Nombre del propietario');
            $table->string('TARJ_DESCRIPCION', 300)->comment('Nombre del propietario');
             $table->boolean('TARJ_ESTADO');
            
            
            //Traza
            $table->string('TARJ_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('TARJ_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('TARJ_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('TARJ_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('TARJ_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('TARJ_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

                   //Relaciones
            $table->foreign('PROP_ID')
            ->references('PROP_ID')
            ->on('PROPIETARIOS')
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
