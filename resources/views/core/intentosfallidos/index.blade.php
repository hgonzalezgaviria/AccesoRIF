@extends('layouts.menu')
@section('title', '/ Intentos Fallidos')


@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Intentos Fallidos
		</div>

		<!--
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{-- route('core.intentosfallidos.create') --}}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
		-->
	</div>

@endsection


@section('section')
	
	
	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">Id</th>
				<th class="col-md-1"> Tag ID</th>
				<th class="col-md-3"> Motivo</th>
				<th class="col-md-1">Fecha</th>		
			</tr>
		</thead>

		<tbody>
			@foreach($intentosfallidos as $intentofallido)
			<tr>
				<td>{{ $intentofallido -> INFA_ID }}</td>
				<td>{{ $intentofallido -> INFA_TAGID }}</td>
				<td>{{ $intentofallido -> INFA_MOTIVO }}</td>
				<td>{{ $intentofallido -> INFA_FECHAPROCESO }}</td>				
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-export')	
@endsection