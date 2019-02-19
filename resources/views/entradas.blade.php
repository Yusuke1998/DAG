@extends('template.layout')
@section('title') Direccion General de Administracion @stop
@section('content')
	<!--Grid row-->

      <!--Grid row-->
      <div class="text-center">
        <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Nueva entrada</a>
      </div>
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-12">
          <!--Card-->
          <div class="card">
			     <div class="card-header">Entradas</div>
            <!--Card content-->
            <div class="card-body">

              <!-- Table  -->
              <table id="tb" class="table table-hover">
                <!-- Table head -->
                <thead class="blue-grey lighten-4">
                  <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Recibido por</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                  </tr>
                </thead>
                <!-- Table head -->

                <!-- Table body -->
                <tbody>
                  @forelse($entradas as $entrada)
                  <tr>
                    <th scope="row">1</th>
                    <td>{{ $entrada->product_id }}</td>
                    <td>
                      @foreach($entrada->products as $producto)
                        {{ $producto->name }}
                      @endforeach
                    </td>
                    <td>{{ $entrada->product_id }}</td>
                    <td>{{ $entrada->product_id }}</td>
                  </tr>
                  @empty
                  <tr>
                    <p>No hay entradas...</p>
                  </tr>
                  @endforelse
                </tbody>
                <!-- Table body -->
              </table>
              <!-- Table  -->

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
      <form id="my_form" method="post">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Detalles de la entrada</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <input type="text" id="reception" name="reception" class="form-control validate">
                <label data-error="wrong" data-success="right" for="reception">Recibe</label>
              </div>
              <div class="md-form mb-5">
                <i class="fas fa-pencil-alt prefix"></i>
                <textarea type="text" id="commentary" name="commentary" class="md-textarea form-control" rows="3"></textarea>
                <label data-error="wrong" data-success="right" for="commentary">Comentario</label>
              </div>
              <select class="browser-default custom-select" name="product_id">
                <option selected disabled>Productos</option>
                @foreach($productos as $producto)
                <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                @endforeach
              </select>
              <div class="md-form mb-5">
                <input placeholder="Ingresa fecha" type="date" name="date" id="date-picker" class="form-control datepicker">
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button id="esubmit" class="btn btn-default">Guardar</button>
            </div>
          </div>
        </div>
      </form>
      </div>

  @section('my-js')
  <script type="text/javascript">
    
    $('#esubmit').on('click', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var form = $('#my_form').serialize();
        var url = '{{ Route('entradas.store') }}';

        $.ajax({
            type: 'post',
            url: url,
            data: form,
            dataType: 'json',
            success: function(data) {
                        $("#tb").load(" #tb");
                        $('#createModal').modal('toggle');
                        alertify.success("agregado con exito");
                    console.log('success');
                    console.log(data);  
                // alert('success');
            },
            error: function(data) {
                    alertify.error("Fallo al agregar");
                var errors = data.responseJSON;
                // alert('error');
            }
        });
    });

    // $(document).ready(function() {
    //   // Material Select Initialization
    //   $('.mdb-select').materialSelect();
    //   // Data Picker Initialization
    //   $('.datepicker').pickadate();
    // });

  </script>
  @stop
@stop