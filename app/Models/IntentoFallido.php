<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class IntentoFallido extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'INTENTOSFALLIDOS';
    protected $primaryKey = 'INFA_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'INFA_FECHACREADO';
	const UPDATED_AT = 'INFA_FECHAMODIFICADO';
	const DELETED_AT = 'INFA_FECHAELIMINADO';
	protected $dates = ['INFA_FECHACREADO', 'INFA_FECHAMODIFICADO', 'INFA_FECHAELIMINADO'];

	protected $fillable = [
		'INFA_TAGID',
		'INFA_MOTIVO',
		'INFA_FECHAPROCESO',		
	];

	public static function rules($id = 0){
		$rules = [
			'INFA_TAGID' => ['required'],
			'INFA_MOTIVO' => ['required'],
			'INFA_FECHAPROCESO' => ['required'],
		];
		return $rules;
	}


}
