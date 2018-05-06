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
            'TARJ_IDTAG'=>'AAAAAAAA',
            'TARJ_DESCRIPCION'=>'111',
            'TARJ_ESTADO'=>true,
            'PROP_ID'=>1
        ]);
        Tarjeta::create([
            'TARJ_IDTAG'=>'BBBBBBBB',
            'TARJ_DESCRIPCION'=>'111',
            'TARJ_ESTADO'=>false,
            'PROP_ID'=>1
        ]);
        Tarjeta::create([
            'TARJ_IDTAG'=>'CCCCCCCC',
            'TARJ_DESCRIPCION'=>'111',
            'TARJ_ESTADO'=>true,
            'PROP_ID'=>2
        ]);
    }
}