@extends('template.layout')
@section('title') Direccion General de Administracion @stop
@section('content')
  <!--Grid row-->
      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-12">

          <!--Card-->
          <div class="card">
           <div class="card-header">Salidas</div>
            <!--Card content-->
            <div class="card-body">

              <!-- Table  -->
              <table class="table table-hover">
                <!-- Table head -->
                <thead class="blue-grey lighten-4">
                  <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Entregado por</th>
                    <th>Recibido por</th>
                    <th>Area</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                  </tr>
                </thead>
                <!-- Table head -->

                <!-- Table body -->
                <tbody>
                  @forelse($salidas as $salida)
                  <tr>
                    <th scope="row">1</th>
                    <td>{{ $salida->product_id }}</td>
                    <td>Cell 2</td>
                    <td>Cell 3</td>
                    <td>Cell 3</td>
                    <td>Cell 3</td>
                    <td>Cell 3</td>
                    <td>Cell 3</td>
                  </tr>
                  @empty
                  <tr>
                    <p>No hay salidas...</p>
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
  @section('my-js')
  
  @stop
@stop