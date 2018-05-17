@extends('layouts.menu')
@section('title', '/ Accesos')
@push('scripts')
 <script type="text/javascript">

	// Date range filter
	var minDateFilter = "";
	var maxDateFilter = "";
	 $.fn.dataTable.ext.search.push(
  		function(oSettings, aData, iDataIndex) {
	    	

	    if (typeof aData._date == 'undefined') {
	      aData._date = new Date(aData[4]).getTime();
	    }

	        console.log(aData._date);
	    if (minDateFilter && !isNaN(minDateFilter)) {
	      if (aData._date <= minDateFilter) {
	        return false;
	      }
	    }

	    if (maxDateFilter && !isNaN(maxDateFilter)) {
	      if (aData._date >= maxDateFilter) {
	        return false;
	      }
	    }

	    return true;
	});

     $(document).ready(function (){
  
	    var table1 = $('#tabla').DataTable();
		 	table1.responsive.rebuild();
			table1.responsive.recalc();
			table1.draw();
			table1.on( 'draw.dt', function () {});

		/*
		Button filter
		*/
		//BUSQUEDA POR COLUMNA
		$('#PROP_ID').change(function () {
		    table1
		        .columns( 1 )
		        .search( $('#PROP_ID option:selected').text() )			 
		        .draw();
		} );

		$('#TARJ_ID').change(function () {
		    table1
		        .columns( 3 )
		        .search( $('#TARJ_ID option:selected').text() )
		        .draw();
		} );
		
		
		$('#ACCE_FECHAENTRADA').datetimepicker({format: 'YYYY-MM-DD'})
		.on('dp.change', function (e) {
    		minDateFilter = new Date(e.date).getTime();
	        console.log(minDateFilter);
		    table1.draw();
		});

		$('#ACCE_FECHASALIDA').datetimepicker({format: 'YYYY-MM-DD'})
		.on('dp.change', function (e) {
    		maxDateFilter = new Date(e.date).getTime();
	        console.log(maxDateFilter);
		    table1.draw();
		});


	  });

     //Obtener fecha del sistemas
		
		function fecha(){
				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1; //hoy es 0!
				var yyyy = hoy.getFullYear();
				var hora = hoy.getHours();
				var minuto = hoy.getMinutes();
				var segundo = hoy.getSeconds(); 

				if(dd<10) {
				    dd='0'+dd
				} 

				if(mm<10) {
				    mm='0'+mm
				} 

				//hoy = mm+'/'+dd+'/'+yyyy;
				hoy = yyyy+mm+dd+'_'+hora+minuto+segundo;

				return hoy;
		}

		

    </script>

@endpush

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