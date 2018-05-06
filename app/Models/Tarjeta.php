<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Tarjeta extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'TARJETAS';
    protected $primaryKey = 'TARJ_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'TARJ_FECHACREADO';
	const UPDATED_AT = 'TARJ_FECHAMODIFICADO';
	const DELETED_AT = 'TARJ_FECHAELIMINADO';
	protected $dates = ['TARJ_FECHACREADO', 'TARJ_FECHAMODIFICADO', 'TARJ_FECHAELIMINADO'];

	protected $fillable = [
		'TARJ_IDTAG',
		'TARJ_DESCRIPCION',
		'TARJ_ESTADO',
		'PROP_ID'
	];

	public static function rules($id = 0){
		$rules = [
			'TARJ_IDTAG' => ['required','max:300'],
			'TARJ_DESCRIPCION' => ['required','max:300'],
			'TARJ_ESTADO' => ['required'],
			'PROP_ID' => ['required'],
		];
		return $rules;
	}
	
	public function propietario()
	{
		$foreingKey = 'PROP_ID';
		return $this->belongsTo(Propietario::class, $foreingKey);
	}

}
