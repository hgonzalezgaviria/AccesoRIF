<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Horario;

class HorarioController extends Controller
{
	protected $route = 'core.horarios';
	protected $class = Horario::class;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{

			$horarios = Horario::select([
							'HORA_ID',
							'HORA_ID_DIA',
							'HORA_DESCRIPCION_DIA',
							'HORA_HORA_INICIO',
							'HORA_HORA_FIN',							
							'HORA_ESTADO',							
						])->get();

			

		/*
		$horarios = Horario::select([
					'HORA_ID',
					'HORA_IDTAG',
					'HORA_DESCRIPCION',
					'HORA_ESTADO',
				])->get();
*/
		return view($this->route.'.index', compact('horarios'));
	}


	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->route.'.create');
	}

	/**
	 * Guarda el registro nuevo en la base de datos.
	 *
	 * @return Response
	 */
	public function store()
	{
		parent::storeModel();
	}

	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $HORA_ID
	 * @return Response
	 */
	public function edit($HORA_ID)
	{
		
		$horario = Horario::findOrFail($HORA_ID);
		return view($this->route.'.edit', compact('horario'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $HORA_ID
	 * @return Response
	 */
	public function update($HORA_ID)
	{
		parent::updateModel($HORA_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $HORA_ID
	 * @return Response
	 */
	public function destroy($HORA_ID)
	{
		parent::destroyModel($HORA_ID);
	}



}

