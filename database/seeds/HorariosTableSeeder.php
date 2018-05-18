<?php

use Illuminate\Database\Seeder;
use App\Models\Horario;

class HorariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

           Horario::create([
            'HORA_ID_DIA'    => 1,
            'HORA_DESCRIPCION_DIA'    => 'LUNES',
            'HORA_HORA_INICIO'  => '07:30:00',
            'HORA_HORA_FIN' => '17:30:00',
            'HORA_ESTADO' =>true,
        ]);

        Horario::create([
          'HORA_ID_DIA'    =>2,
            'HORA_DESCRIPCION_DIA'    => 'MARTES',
            'HORA_HORA_INICIO'  => '13:30:00',
            'HORA_HORA_FIN' => '18:00:00',
            'HORA_ESTADO' =>true,
            
        ]);
   
    }
}