@extends('layout')

@section('content')

<h1 class="page-header">Recurso {{ $recurso->id }}: {{ $recurso->descripcion }} </h1>

	<div class="jumbotron text-center">
		<h3><strong>Recurso {{ $recurso->id }}:</strong> {{ $recurso->descripcion }}</h3>
		<p>
			<strong>Observaciones:</strong> {{ $recurso->observaciones }} <br>
		</p>
	</div>
	<div class="text-right">
		<a class="btn btn-primary" role="button" href="{{ URL::to('recursos/') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
		</a>
	</div>

@endsection