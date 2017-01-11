<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Equipo;

class EquiposController extends Controller
{
    //
    public function __construct(Redirector $redirect=null)
    {
        //Requiere que el usuario inicie sesión.
        $this->middleware('auth');
        if(isset($redirect)){

            $action = Route::currentRouteAction();
            $role = isset(auth()->user()->rol->ROLE_ROL) ? auth()->user()->rol->ROLE_ROL : 'guest';
            
            //Lista de acciones que solo puede realizar los administradores o los editores
            $arrActionsAdmin = array('index', 'create', 'edit', 'store', 'show', 'destroy');

            if(in_array(explode("@", $action)[1], $arrActionsAdmin))//Si la acción del controlador se encuentra en la lista de acciones de admin...
            {
                if( ! in_array($role , ['admin','editor']))//Si el rol no es admin o editor, se niega el acceso.
                {
                    Session::flash('error', '¡Usuario no tiene permisos!');
                    abort(403, '¡Usuario no tiene permisos!.');
                }
            }
        }
    }

    /**
     * Muestra una lista de los registros.
     *
     * @return Response
     */
    public function index()
    {
        //Se genera paginación cada $cantPages registros.
        $equipos = Equipo::all();
        //Se obtienen todas los contratos.


        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('equipos/index', compact('equipos'));
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('equipos/create');
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
                'descripcion' => ['required', 'max:50']
            ]);
        //Guarda todos los datos recibidos del formulario
        $tipoestado = request()->except(['_token']);


        Equipo::create($tipoestado);

        //Permite seleccionar los datos que se desean guardar.
        /*
        $contrato = new Contrato;
        $contrato->titulo = Input::get('titulo');
        $contrato->status = Contrato::NUEVA;
        $contrato->created_by = auth()->user()->username;
        $contrato->save();
        */

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de estado creado exitosamente!');
        return redirect()->to('equipos');
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
        $tipoestado = Equipo::find($id);
        // Muestra la vista y pasa el registro
        return view('equipos/show')->with('tipoestado', $tipoestado);
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
        $tipoestado = Equipo::find($id);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('equipos/edit')->with('tipoestado', $tipoestado);
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
        $this->validate(request(), [
            'descripcion' => ['required', 'max:100'],
            'observaciones' => ['max:500']
        ]);

        // Se obtiene el registro
        $tipoestado = Equipo::find($id);
        $tipoestado->descripcion = Input::get('descripcion');
        $tipoestado->observaciones = Input::get('observaciones');
        //$tipoestado->edited_by = auth()->user()->username;
        $tipoestado->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de estado actualizado exitosamente!');
        return redirect()->to('equipos/'.$id);
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
        $tipoestado = Equipo::find($id);
        $tipoestado->delete();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo estado '.$id.' borrado!');
        return redirect()->to('equipos');
    }
    
}
