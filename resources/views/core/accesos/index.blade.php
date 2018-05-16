	@extends('layouts.menu')
@section('title', '/ Accesos')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Detalle de Accesos
		</div>

		<!--
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{-- route('core.accesos.create') --}}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
		-->
	</div>

@endsection


@section('section')

	@rinclude('FormFilters')
	
	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">Id</th>
				<th class="col-md-1"> Cedula</th>
				<th class="col-md-3"> Nombre Usuario</th>
				<th class="col-md-1">RFID</th>
				<th class="col-md-3">Fecha Entrada</th>
				<th class="col-md-3">Fecha Salida</th>
				<!--th class="col-md-1">Tipo Acceso</th-->
				<th class="col-md-1">Estado</th>
			</tr>
		</thead>

		<tbody>
			@foreach($accesos as $acceso)
			<tr>
				<td>{{ $acceso -> ACCE_ID }}</td>
				<td>{{ $acceso -> PROP_CEDULA }}</td>
				<td>{{ $acceso -> PROP_NOMBRE }}</td>
				<td>{{ $acceso -> TARJ_IDTAG }}</td>
				<td>{{ $acceso -> ACCE_FECHAENTRADA }}</td>
				<td>{{ $acceso -> ACCE_FECHASALIDA }}</td>				
				<td>{{ $acceso -> ACCE_ESTADO=="E" ? 'ENTRADA' : 'SALIDA'  }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-export')	
@endsection