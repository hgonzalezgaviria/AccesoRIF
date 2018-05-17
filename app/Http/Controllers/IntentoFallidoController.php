<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Models\IntentoFallido;


class IntentoFallidoController extends Controller
{
	protected $route = 'core.intentosfallidos';
	protected $class = IntentoFallido::class;

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
	
		$intentosfallidos = IntentoFallido::select([
					'INFA_ID',
					'INFA_TAGID',
					'INFA_MOTIVO',
					'INFA_FECHAPROCESO',
				])->get();


		return view($this->route.'.index', compact('intentosfallidos'));
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
	 * @param  int  $INFA_ID
	 * @return Response
	 */
	public function edit($INFA_ID)
	{
		$intentofallido = Acceso::findOrFail($INFA_ID);
		return view($this->route.'.edit', compact('intentofallido'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $INFA_ID
	 * @return Response
	 */
	public function update($INFA_ID)
	{
		parent::updateModel($INFA_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $INFA_ID
	 * @return Response
	 */
	public function destroy($INFA_ID)
	{
		parent::destroyModel($INFA_ID);
	}
	

}