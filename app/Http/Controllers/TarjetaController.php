<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Tarjeta;

class TarjetaController extends Controller
{
	protected $route = 'core.tarjetas';
	protected $class = Tarjeta::class;

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
		$tarjetas = Tarjeta::select([
					'TARJ_ID',
					'TARJ_IDTAG',
					'TARJ_DESCRIPCION',
					'TARJ_ESTADO',
				])->get();

		return view($this->route.'.index', compact('tarjetas'));
	}


	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->route.'.create', $this->getArraysSelect());
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
	 * @param  int  $TARJ_ID
	 * @return Response
	 */
	public function edit($TARJ_ID)
	{
		$tarjeta = Tarjeta::findOrFail($TARJ_ID);
		return view($this->route.'.edit', $this->getArraysSelect()+compact('tarjeta'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $TARJ_ID
	 * @return Response
	 */
	public function update($TARJ_ID)
	{
		parent::updateModel($TARJ_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $TARJ_ID
	 * @return Response
	 */
	public function destroy($TARJ_ID)
	{
		parent::destroyModel($TARJ_ID);
	}

	private function getArraysSelect()
	{

		$PROP_NOMBRECOMPLETO = expression_concat([
			'PROP_CEDULA',
			'PROP_NOMBRE',
			'PROP_APELLIDO',
		], 'PROP_NOMBRECOMPLETO');
		$arrPropietario = model_to_array(Propietario::class, $PROP_NOMBRECOMPLETO);

		return compact('arrPropietario');
		
	}

}

