<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Acceso extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'ACCESOS';
    protected $primaryKey = 'ACCE_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'ACCE_FECHACREADO';
	const UPDATED_AT = 'ACCE_FECHAMODIFICADO';
	const DELETED_AT = 'ACCE_FECHAELIMINADO';
	protected $dates = ['ACCE_FECHACREADO', 'ACCE_FECHAMODIFICADO', 'ACCE_FECHAELIMINADO'];

	protected $fillable = [
		'ACCE_FECHAENTRADA',
		'ACCE_FECHASALIDA',
		'ACCE_TIPOACCESO',
		'ACCE_ESTADO',
		'PROP_ID',
		'TARJ_ID',
	];

	public static function rules($id = 0){
		$rules = [
			'ACCE_FECHAENTRADA' => ['required'],
			'ACCE_FECHASALIDA' => ['required'],
			'ACCE_TIPOACCESO' => ['required'],
			'ACCE_ESTADO' => ['required'],
		];
		return $rules;
	}
	
	public function propietario()
	{
		$foreingKey = 'PROP_ID';
		return $this->belongsTo(Propietario::class, $foreingKey);
	}
	public function tarjeta()
	{
		$foreingKey = 'TARJ_ID';
		return $this->belongsTo(Tarjeta::class, $foreingKey);
	}

}
