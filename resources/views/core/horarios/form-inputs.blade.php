@include('datepicker')
@include('chosen')
<div class='col-md-8 col-md-offset-2'>
	<div class="row">
		@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'HORA_ID_DIA', 'label'=>'Seleccionar Día', 'data'=>[1=>'Lunes',2=>'Martes',3=>'Miercoles',4=>'Jueves',5=>'Viernes',6=>'Sabado',7=>'Domingo']])

		@if(current_route_action() == 'create')
			@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'HORA_ESTADO', 'label'=>'Estado', 'data'=>[1=>'ACTIVO',0=>'INACTIVO'] , 'value'=>1, 'class'=>'readonly'])
		@else
			@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'HORA_ESTADO', 'label'=>'Estado', 'data'=>[1=>'ACTIVO',0=>'INACTIVO']])
		@endif
	</div>

	<div class="row">
		@include('widgets.forms.input', ['type'=>'text', 'column'=>6, 'name'=>'HORA_DESCRIPCION_DIA', 'label'=>'Descripción', 'options'=>['maxlength' => '300', 'required'] ])

		
		@include('widgets.forms.input', ['type'=>'time', 'column'=>3, 'name'=>'HORA_HORA_INICIO', 'label'=>'Hora inicio' ])
		@include('widgets.forms.input', ['type'=>'time', 'column'=>3, 'name'=>'HORA_HORA_FIN', 'label'=>'Hora fin' ])
	</div>

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/horarios'])

</div>