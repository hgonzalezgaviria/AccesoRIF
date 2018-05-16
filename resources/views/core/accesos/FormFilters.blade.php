@include('chosen')
@include('datepicker')
@section('head')
	<style>
		/* Define el tamaño de los input-group-addon para que sean todos iguales */
		.input-group-addon {
			min-width:100px;
			text-align:left;
		}
	</style>
@parent
@endsection



<!-- Filtrar datos en vista -->

<div id="frm-find" class="col-xs-3 col-md-9 col-lg-9">
	<a class='btn btn-primary' role='button' data-toggle="collapse" data-target="#filters" href="#">
		<i class="fa fa-filter" aria-hidden="true"></i> 
		<span class="hidden-xs">Filtrar resultados</span>
		<span class="sr-only">Filtrar</span>
	</a>
</div>


<div id="filters" class="collapse">
	<div class="form-group col-xs-12 col-md-8">
		{{ Form::open(['id'=>'formFilter' , 'class' => 'form-vertical']) }}

	
		@include('widgets.forms.input', ['type'=>'select', 'column'=>5, 'name'=>'PROP_ID', 'id'=>'PROP_ID', 'label'=>'Propietario', 'data'=>$arrPropietarios, 'options'=>['required']])

		@include('widgets.forms.input', ['type'=>'select', 'column'=>5, 'name'=>'TARJ_ID', 'id'=>'TARJ_ID',  'label'=>'Tarjeta', 'data'=>$arrTarjetas, 'options'=>['required']])

		@include('widgets.forms.input', ['type'=>'date', 'column'=>5, 'name'=>'ACCE_FECHAENTRADA', 'label'=>'Fecha Inicio', 'options'=>['required'] ])
		@include('widgets.forms.input', ['type'=>'date', 'column'=>5, 'name'=>'ACCE_FECHASALIDA', 'label'=>'Fecha Fin', 'options'=>['required'] ])

	{{ Form::close() }}
	</div>
</div>

