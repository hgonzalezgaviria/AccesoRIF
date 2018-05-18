@extends('layouts.menu')
@section('title', '/ Horarios')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Horarios
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('core.horarios.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">ID</th>
				<th class="col-md-1">ID_DÍA</th>
				<th class="col-md-4">Descripción</th>
				<th class="col-md-2">Hora inicio</th>
				<th class="col-md-2">Hora Fin</th>
				<th class="col-md-2">Estado</th>

				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($horarios as $horario)
			<tr>
				<td>{{ $horario -> HORA_ID }}</td>
				<td>{{ $horario -> HORA_ID_DIA }}</td>
				<td>{{ $horario -> HORA_DESCRIPCION_DIA }}</td>
				<td>{{ $horario -> HORA_HORA_INICIO }}</td>
				<td>{{ $horario -> HORA_HORA_FIN }}</td>
				<td>{{ $horario -> HORA_ESTADO ? 'ACTIVO' : 'INACTIVO' }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('core.horarios.edit', [ 'HORA_ID' => $horario->HORA_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $horario->HORA_ID,
						'data-modelo'=> str_upperspace(class_basename($horario)),
						'data-descripcion'=> $horario->HORA_DESCRIPCION_DIA,
						'data-action'=>'horarios/'. $horario->HORA_ID,
						'data-target'=>'#pregModalDelete',
						'data-tooltip'=>'tooltip',
						'title'=>'Borrar',
					])}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-export')	
@endsection