@extends('layouts.menu')

@section('page_heading', 'Nuevo Tarjeta RFID')

@section('section')
{{ Form::open(['route' => 'core.tarjetas.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
