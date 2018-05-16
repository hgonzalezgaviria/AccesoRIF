@extends('layouts.menu')

@section('page_heading', 'Nuevo Horario')

@section('section')
{{ Form::open(['route' => 'core.horarios.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
