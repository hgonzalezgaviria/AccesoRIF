@section('head')
  <style type="text/css">
    .modal {
      text-align: center;
    }

    @media screen and (min-width: 768px) { 
      .modal:before {
      display: inline-block;
      vertical-align: middle;
      content: " ";
      height: 100%;
      }
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }

    .fa-3x{
      vertical-align: middle;
    }

  </style>
@parent
@endsection


  <div class="modal fade" id="modalPrestamoEquipos" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

          <div class="modal-header">
            <h4><span class="glyphicon glyphicon-floppy-saved"></span> Prestamo de equipo</h4>
          </div>

          <div class="modal-body">

            <form id="frmPrestamo" method="POST" action="{{URL('reservas/prestamoEquipo')}}" accept-charset="UTF-8" class="frmModal pull-right">
              {{ Form::token() }}
              <div class="form-group">
                <label for="equipo"> Equipo</label>
                <input type="text" class="form-control" id="equipo" placeholder="ID del equipo a prestar" readonly>
              </div>

              <div class="form-group">
                <label for="doc_usuario"> Cod/ID</label>
                <input type="text" class="form-control" id="doc_usuario" placeholder="Ingrese el codigo del documento">
              </div>
              <div class="form-group">
                <label for="nombre"> Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" placeholder=" Ingrese el nombre">
              </div>

                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
                  <span class="glyphicon glyphicon-remove"></span> Cancelar
                </button>
                <button type="submit" class="btn btn-success btn-block">
                  <span class="glyphicon glyphicon-off"></span> Prestamo
                </button>
            
            </form>
          </div>

          <div class="modal-footer">
          </div>
      </div>
      
    </div>
  </div> 