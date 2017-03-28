{{-- Utilizado para mostrar mensajes provenientes de los controladores --}}

<!-- ALERTAS -->
<div class="alertas">
	@if (Session::has('alert-info'))
		<div class="alert alert-info alert-flash">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><i class="fa fa-info-circle fa-2x fa-pull-left" aria-hidden="true"></i></strong>
			{{ Session::get('alert-info') }}
		</div>
	@endif
	@if (Session::has('alert-success alert-flash'))
		@foreach(Session::get('alert-success') as $msg)
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><i class="fa fa-exclamation-triangle fa-2x fa-pull-left" aria-hidden="true"></i></strong>
			{{ $msg }}
		</div>
		@endforeach
	@endif
	@if (Session::has('alert-warning alert-flash'))
		@foreach(Session::get('alert-warning') as $msg)
		<div class="alert alert-warning">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><i class="fa fa-exclamation-triangle fa-2x fa-pull-left" aria-hidden="true"></i></strong>
			{{ $msg }}
		</div>
		@endforeach
	@endif
	@if (Session::has('alert-danger alert-flash'))
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><i class="fa fa-exclamation-triangle fa-2x fa-pull-left" aria-hidden="true"></i></strong>
			{{ Session::get('alert-danger') }}
		</div>
	@endif
</div>

<!-- MODALES -->
	<!-- Mensaje Modal-->
	<div class="modal fade" id="messageModal" role="dialog" tabindex="-1" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header panel-heading" style="border-top-left-radius: inherit; border-top-right-radius: inherit;">
					<h4 class="modal-title"></h4>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-xs-2">
							<i class="fa fa-exclamation-triangle fa-3x fa-fw"></i>
						</div>
						<div class="col-xs-10">
							<h4 id="message"></h4>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-xs btn-success" data-dismiss="modal">
						<i class="fa fa-times" aria-hidden="true"></i> OK
					</button>

				</div>
			</div>
		</div>
	</div><!-- Fin de Mensaje Modal.-->
{{dump(Session::all())}}
@section('scripts')
	<script type="text/javascript">

		//Se cierra la alerta a los 5 segundos.
		setTimeout(function () {
        	$('.alert-flash').slideUp(500, function(){
			    $(this).alert('close');
			});
		}, 5000);

		//Si el mensaje es modal, se configura la ventana según el tipo de mensaje (success, warning y danger).
		@if (Session::has('modal-success'))
			$(document).ready(function () {
				var modal = $('#messageModal');
				modal.find('#message').html('{{{Session::get('modal-success')}}}');
				modal.find('.modal-content')
					.addClass('panel-success')
					.find('.modal-title').text('¡Operación exitosa!');
				modal.modal('show');
			})
		@endif
		@if (Session::has('modal-warning'))
			$(document).ready(function () {
				var modal = $('#messageModal');
				modal.find('#message').html('{{{Session::get('modal-warning')}}}');
				modal.find('.modal-content')
					.addClass('panel-warning')
					.find('.modal-title').text('¡Advertencia!');
				modal.modal('show');
			})
		@endif
		@if (session()->has('modal-danger'))
			$(document).ready(function () {
				var modal = $('#messageModal');
				modal.find('#message').html('{{{Session::get('modal-danger')}}}');
				modal.find('.modal-content')
					.addClass('panel-danger')
					.find('.modal-title').text('¡Error!');
				modal.modal('show');
			})
		@endif
	</script>
@parent
@endsection