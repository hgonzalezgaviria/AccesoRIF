<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Horario extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'HORARIOS';
    protected $primaryKey = 'HORA_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'HORA_FECHACREADO';
	const UPDATED_AT = 'HORA_FECHAMODIFICADO';
	const DELETED_AT = 'HORA_FECHAELIMINADO';
	protected $dates = ['HORA_FECHACREADO', 'HORA_FECHAMODIFICADO', 'HORA_FECHAELIMINADO'];

	protected $fillable = [
		'HORA_ID_DIA',
		'HORA_DESCRIPCION_DIA',
		'HORA_HORA_INICIO',
		'HORA_HORA_FIN',
		'HORA_ESTADO'
	];

	public static function rules($id = 0){
		$rules = [
			'HORA_ID_DIA' => ['required'],
			'HORA_DESCRIPCION_DIA' => ['required','max:300'],
			'HORA_HORA_INICIO' => ['required'],
			'HORA_HORA_FIN' => ['required'],
			'HORA_ESTADO' => ['required'],
		];
		return $rules;
	}


}
