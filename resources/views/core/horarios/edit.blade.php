@extends('layouts.menu')

@section('page_heading', 'Actualizar Horario')

@section('section')
{{ Form::model($horario, ['action' => ['HorarioController@update', $horario->HORA_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection