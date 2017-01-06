<?php

namespace reservas\Http\Controllers;

use reservas\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = \reservas\Sede::getEspaciosFisicos();
        $salas = \reservas\Sala::getSalas();
        return view('home', compact('sedes', 'salas'));
    }
}
