@extends('layouts.menu')
@section('title', '/ Tarjetas')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Tarjetas
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('core.tarjetas.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">ID Tarjeta RFID</th>
				<th class="col-md-3">Descripción</th>
				<th class="col-md-3">Propietario</th>
				<th class="col-md-3">Estado</th>

				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($tarjetas as $tarjeta)
			<tr>
				<td>{{ $tarjeta -> TARJ_IDTAG }}</td>
				<td>{{ $tarjeta -> TARJ_DESCRIPCION }}</td>
				<td>{{ $tarjeta -> PROP_NOMBRE }}</td>
				<td>{{ $tarjeta -> TARJ_ESTADO ? 'ACTIVO' : 'INACTIVO' }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('core.tarjetas.edit', [ 'TARJ_ID' => $tarjeta->TARJ_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{-- Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $tarjeta->TARJ_ID,
						'data-modelo'=> str_upperspace(class_basename($tarjeta)),
						'data-descripcion'=> $tarjeta->TARJ_IDTAG,
						'data-action'=>'tarjetas/'. $tarjeta->TARJ_ID,
						'data-target'=>'#pregModalDelete',
						'data-tooltip'=>'tooltip',
						'title'=>'Borrar',
					])--}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-export')	
@endsection