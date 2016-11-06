<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;
use reservas\Tiporecursofisico;
use Illuminate\Support\Facades\Input;

use Session;

class TiporecursofisicoController extends Controller
{

    /**
     * Muestra una lista de los registros.
     *
     * @return Response
     */
    public function index()
    {
        //Se obtienen todas los tiporecursofisicos.
        $tiporecursofisicos = Tiporecursofisicos::all();

        //dd($tiporecursofisicos);
        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('tiporecursofisicos/index')->with('tiporecursofisicos', $tiporecursofisicos);
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)

        $cargos = \DB::table('cargos')
                            ->select('cargos.*')
                            ->get();

        return view('tiporecursofisicos/create', compact('cargos'));
    }

    /**
     * Guarda el registro nuevo en la base de datos.
     *
     * @return Response
     */
    public function store()
    {
        //Validación de datos
        $this->validate(request(), [
                'nombres' => ['required', 'max:50']
            ]);
        //Guarda todos los datos recibidos del formulario
        $contrato = request()->except(['_token']);


        Tiporecursofisicos::create($contrato);

        //dd($contrato);

        //Permite seleccionar los datos que se desean guardar.
        /*
        $contrato = new Tiporecursofisicos;
        $contrato->titulo = Input::get('titulo');
        $contrato->status = Tiporecursofisicos::NUEVA;
        $contrato->created_by = auth()->user()->username;
        $contrato->save();
        */

        // redirecciona al index de controlador
        Session::flash('message', '¡Tiporecursofisicos creado exitosamente!');
        return redirect()->to('tiporecursofisicos');
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Se obtiene el registro
        //$contrato = Tiporecursofisicos::find($id);
        // Muestra la vista y pasa el registro

        $contrato = \DB::table('tiporecursofisicos')
                            ->join('cargos','tiporecursofisicos.cargo','=','cargos.id')
                            ->select('tiporecursofisicos.*','cargos.cargo as cargo_desc')
                            ->where('tiporecursofisicos.id','=',$id)
                            ->get()[0];

        return view('tiporecursofisicos/show', compact('contrato'));
    }

    /**
     * Muestra el formulario para editar un registro en particular.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // Se obtiene el registro
        $contrato = Tiporecursofisicos::find($id);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('tiporecursofisicos/edit')->with('contrato', $contrato);
    }

    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //Validación de datos
        /*
        $this->validate(request(), [
            'titulo' => ['required', 'max:50']
        ]);
        */

        // Se obtiene el registro
        $contrato = Tiporecursofisicos::find($id);

        $contrato->cedula = Input::get('cedula');
        $contrato->nombres = Input::get('nombres');
        $contrato->apellidos = Input::get('apellidos');
        $contrato->sexo = Input::get('sexo');
        $contrato->caso_medico = Input::get('caso_medico');
        $contrato->nro_contrato = Input::get('nro_contrato');
        $contrato->tipo_contrato = Input::get('tipo_contrato');
        $contrato->cargo = Input::get('cargo');
        $contrato->estado_contrato = Input::get('estado_contrato');
        $contrato->fecha_ingreso = Input::get('fecha_ingreso');

        if(Input::has('fecha_retiro')){
            $contrato->fecha_retiro = Input::get('fecha_retiro');
        }
        
        $contrato->salario = Input::get('salario');
        $contrato->tipo_nomina = Input::get('tipo_nomina');
        $contrato->cno = Input::get('cno');
        $contrato->centro_costo = Input::get('centro_costo');
        $contrato->gerencia = Input::get('gerencia');
        $contrato->empleador = Input::get('empleador');



        //$contrato->edited_by = auth()->user()->username;
        $contrato->save();

        // redirecciona al index de controlador
        Session::flash('message', '¡Tiporecursofisicos actualizada exitosamente!');
        return redirect()->to('tiporecursofisicos/'.$id);
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $contrato = Tiporecursofisicos::find($id);
        $contrato->delete();

        // redirecciona al index de controlador
        Session::flash('message', '¡Tiporecursofisicos '.$id.' borrado!');
        return redirect()->to('tiporecursofisicos');
    }



}

