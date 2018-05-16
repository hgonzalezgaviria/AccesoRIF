<?php

use Illuminate\Database\Seeder;
use App\Models\Tarjeta;

class TarjetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarjeta::create([
            'TARJ_IDTAG'=>'6E8147E',
            'TARJ_DESCRIPCION'=>'Tag de Llavero RFID',
            'TARJ_ESTADO'=>true,
            'PROP_ID'=>1
        ]);
        Tarjeta::create([
            'TARJ_IDTAG'=>'96802C5',
            'TARJ_DESCRIPCION'=>'Tag de Tarjeta RFID',
            'TARJ_ESTADO'=>false,
            'PROP_ID'=>1
        ]);
        Tarjeta::create([
            'TARJ_IDTAG'=>'0F0772B',
            'TARJ_DESCRIPCION'=>'Tag de Tarjeta RFID',
            'TARJ_ESTADO'=>true,
            'PROP_ID'=>3
        ]);
    }
}