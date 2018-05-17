<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;

use App\Models\Acceso;
use App\Models\Tarjeta;
use App\Models\Propietario;
use App\Models\Horario;
use App\Models\IntentoFallido;
use Carbon\Carbon;

class AccesoController extends Controller
{
	protected $route = 'core.accesos';
	protected $class = Acceso::class;

	public function __construct()
	{
		//parent::__construct();
		$this->middleware('auth')->except(['verifyUserAccess']);
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		$accesos = Acceso::leftJoin('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'ACCESOS.PROP_ID')
						->leftJoin('TARJETAS', 'TARJETAS.TARJ_ID', '=', 'ACCESOS.TARJ_ID')
						->select([
							'ACCE_ID',
							'PROP_CEDULA',
							'PROP_NOMBRE',
							'PROP_APELLIDO',
							'TARJ_IDTAG',							
							'ACCE_FECHAENTRADA',
							'ACCE_FECHASALIDA',
							'ACCE_TIPOACCESO',
							'ACCE_ESTADO',
						])->get();
/*
		$PROP_NOMBRECOMPLETO = expression_concat([
			'PROP_CEDULA',
			'PROP_NOMBRE',
			'PROP_APELLIDO',
		], 'PROP_NOMBRECOMPLETO');
*/
		$arrPropietarios = model_to_array(Propietario::class, 'PROP_CEDULA');

		$arrTarjetas = model_to_array(Tarjeta::class, 'TARJ_IDTAG');

		return view($this->route.'.index', compact('accesos','arrPropietarios','arrTarjetas'));
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
	 * @param  int  $ACCE_ID
	 * @return Response
	 */
	public function edit($ACCE_ID)
	{
		$acceso = Acceso::findOrFail($ACCE_ID);
		return view($this->route.'.edit', compact('acceso'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $ACCE_ID
	 * @return Response
	 */
	public function update($ACCE_ID)
	{
		parent::updateModel($ACCE_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $ACCE_ID
	 * @return Response
	 */
	public function destroy($ACCE_ID)
	{
		parent::destroyModel($ACCE_ID);
	}

	private function getArraysSelect()
	{
		//Se crea un array con los vehiculos disponibles
		//$arrVehiculos = model_to_array(Vehiculo::class, 'VEHI_PLACA');

		//return compact('arrVehiculos');
	}

	public function validaHorario(){

	}

		public function addIntento($motivo, $id){

			IntentoFallido::create([
						'INFA_TAGID'=>$id,
						'INFA_MOTIVO'	=>$motivo,
						'INFA_FECHAPROCESO'=>Carbon::now(),				
					]);

	}

	public function verifyUserAccess(Request $request)
	{
		$id = $request->input('tagid');
		$tarjeta = Tarjeta::with('propietario')->where('TARJ_IDTAG', $id)
							//->where('TARJ_ESTADO', true)
							->has('propietario')
							->get()->first();

		//if($tarjeta->TARJ_ESTADO)


		if(!isset($tarjeta)){
			$this->addIntento('Tarjeta no esta registrada', $id);				
			return json_encode(["success" => 0]);

			}elseif (!$tarjeta->TARJ_ESTADO) {
				$this->addIntento('Tarjeta inactiva', $tarjeta->TARJ_IDTAG);
				return json_encode(["success" => 0]);				
			}else{

				$prop_id = $tarjeta->propietario->PROP_ID;
		$acceso = Acceso::where('PROP_ID', $prop_id)
						->where('TARJ_ID',$tarjeta->TARJ_ID)
						->where('ACCE_ESTADO','E')
						->where('ACCE_FECHASALIDA', NULL)
						->get()->first();

		//dump($acceso);
		if(isset($acceso)){
			$acceso->update([
				'ACCE_TIPOACCESO'=>2,
				'ACCE_ESTADO'	=>'S',
				'ACCE_FECHASALIDA'=>Carbon::now(),
				]);
			$this->addIntento('Una entrada sin salida', $tarjeta->TARJ_IDTAG);				
			return json_encode(["success" => 2]); //Sale
		} else {
			//dd($acceso);
			Acceso::create([
				'ACCE_TIPOACCESO'=>1,
				'ACCE_ESTADO'	=>'E',
				'ACCE_FECHAENTRADA'=>Carbon::now(),
				'PROP_ID'=>$prop_id,
				'TARJ_ID'=>$tarjeta->TARJ_ID,
			]);
		}

		return json_encode(["success" => 1]); //Entra
		
		}
		
	}

}