@extends('layout')
@section('title', '/ Consulta Reservas')
@include('datatable')
@section('content')
@section('scripts')
	{!! Html::script('assets/js/jquery.countdown.min.js') !!}
    <script>

    	
     $(document).ready(function (){

	//DatetimePicker
     	 $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
   	 });

		//Formato de fecha
		var formatDate = function(strDate){
			var strDateFormatted = moment(strDate).format('DD/MM/YYYY hh:mm A');
			return strDateFormatted;
		}


		var setCounterTime = function(){
			//Contador
			$('.counterTime').each(function() {
				var $this = $(this), fechaInicio = $(this).parent().find('.fechaInicio').data('fechainicio');
				$this.countdown(fechaInicio, {elapse: true})
				.on('update.countdown', function(event) {
					var $this = $(this);
					var totalHours = event.offset.totalDays * 24 + event.offset.hours;
					$this.html(event.strftime(totalHours + ' hr %M min %S seg'));
					//$this.html(event.strftime(totalHours + ':%M:%S'));
				});
			});


			//Cambiar de formato de fecha inicio
			$('.fechaInicio').each(function( index ) {
				var fecha = $( this );
				var fechaStr = formatDate(fecha.data('fechainicio'));
				fecha.html(fechaStr);
			});

		}

	    var table1 = $('#tabla').DataTable();
		setCounterTime();

		$( table1.column( 6 ).header() ).addClass( 'all' );
		$( table1.column( 7 ).header() ).addClass( 'all' );
		table1.responsive.rebuild();
		table1.responsive.recalc();
		table1.draw();

		table1.on( 'draw.dt', function () {
		    setCounterTime();
		} );

		/*
		Button filter
		*/
		//BUSQUEDA POR COLUMNA

		$('#COD_ID').on( 'keyup', function () {
		    table1
		        .columns( 3 )
		        .search( this.value )
		        .draw();
		} );


		$('#SALA_ID').change(function () {
		    table1
		        .columns( 4 )
		        .search( $('#SALA_ID option:selected').text() )
		        .draw();
		} );

	//CARGA DE COMBO POR JQUERY

		$('#SEDE_ID').change(function () {
		    table1
		        .columns( 5 )
		        .search( $('#SEDE_ID option:selected').text() )
		        .draw();


		      //Habilitar selector de Salas

			 
	 	crsfToken = document.getElementsByName("_token")[0].value;
 		var opcion = $("#SEDE_ID").val();
			$.ajax({
	             url: 'consultaSalas',
	             data: 'sede='+ opcion,
	             dataType: "json",
	             type: "POST",
	             headers: {
	                    "X-CSRF-TOKEN": crsfToken
	                },
	              success: function(sala) {
	         
	        $('#SALA_ID').empty();
	      

			for(var i = 0; i < sala.length; i++){
			$("#SALA_ID").append('<option value=' + sala[i].SALA_ID + '>' + sala[i].SALA_DESCRIPCION + '</option>');

			} 
	                
	              },
	              error: function(json){
	                console.log("Error al crear evento");
	              }        
        	}); //Fin ajax
		} );

	  });
		

    </script>
@parent
@endsection

	<h1 class="page-header">Consulta Reservas</h1>
	<div class="row well well-sm">
	@include('consultas/reservas/FormFilters')

	<div id="btn-create" class="pull-right">
			<a class='btn btn-primary' role='button' href="#">
				<i class="fa fa-plus" aria-hidden="true"></i> Todos los datos
			</a>
		</div>

	</div>
	
<table class="table table-striped" id="tabla">
	<thead>
		<tr class="info">
			<th class="col-xs-1">ID</th>
			<th class="col-xs-2">Fecha y Hora Inicio</th>
			<th class="col-xs-2">Fecha y Hora Fin</th>
			<th class="col-xs-2">Descripción</th>			
			<th class="col-xs-2">Sala</th>
			<th class="col-xs-2">Sede</th>
			<th class="col-xs-1">Creado por</th>			
			<th> </th>

		</tr>
	</thead>
	<tbody>


		@foreach($reservas as $reserva)
		<tr>
			<td>{{ $reserva -> RESE_ID }}</td>
			<td class="fechaInicio" data-fechainicio="{{ $reserva -> RESE_FECHAINI }}"></td>
			<td class="fechaInicio" data-fechainicio="{{ $reserva -> RESE_FECHAFIN }}"></td>
			<td>{{ $reserva -> RESE_TITULO }}</td>			 	
			<td>{{ $reserva -> sala -> SALA_DESCRIPCION }}</td>
			<td>{{ $reserva -> sala -> sede -> SEDE_DESCRIPCION }}</td>
			<td>{{ $reserva -> RESE_CREADOPOR }}</td>
		
			<td>

		
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{--@include('consultas/prestamos/index-modalTerminar')--}}
@endsection