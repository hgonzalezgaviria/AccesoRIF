@extends('layout')
@section('title', '/ Editar Rol '.$rol->ROLE_id)

@section('content')

	<h1 class="page-header">Actualizar Rol</h1>

	@include('partials/errors')

	{{ Form::model($rol, ['action' => ['Auth\RolController@update', $rol->ROLE_id ], 'method' => 'PUT', 'class' => 'form-vertical' ]) }}

	  	<div class="form-group">
			{{ Form::label('ROLE_rol', 'Rol') }}
 			<a href="#" title="No editable" data-toggle="popover" data-trigger="hover" data-placement="auto" data-content="Rol creado por SYSTEM">
			{{ Form::text('ROLE_rol', old('ROLE_rol'), [
				'class' => 'form-control',
				'max' => '15',
				'required',
				$rol->ROLE_creadopor === 'SYSTEM' ? 'disabled' : '',
			]) }}
			</a>
		</div>

	  	<div class="form-group">
			{{ Form::label('ROLE_descripcion', 'Descripción') }} 
			{{ Form::text('ROLE_descripcion', old('ROLE_descripcion'), [ 'class' => 'form-control', 'max' => '255', 'required' ]) }}
		</div>

		<!-- Botones -->
	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', [ 'class'=>'btn btn-warning', 'type'=>'reset' ]) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('roles/') }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', [ 'class'=>'btn btn-primary', 'type'=>'submit' ]) }}
	    </div>

	{{ Form::close() }}
@endsection

@section('scripts')
	<script>
		$(document).ready(function(){
		    $('[data-toggle="popover"]').popover();
		});
	</script>
@endsection