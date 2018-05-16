@extends('layouts.menu')

@section('page_heading', 'Actualizar Tarjeta RFID')

@section('section')
{{ Form::model($tarjeta, ['action' => ['TarjetaController@update', $tarjeta->TARJ_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection