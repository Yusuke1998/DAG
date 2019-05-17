@extends('template.layout')
@section('title') Direccion General de Administracion @stop
@section('content')
  <!--Grid row-->
      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-12">
          <div class="card">
            <div class="card-header">Graficas</div>
            <div class="card-body">
              <canvas id="entradas_salidas" width="600" height="400"></canvas>
            </div>
          </div>
        </div>
        
        <div class="col-md-12 mb-12">
          <!--Card-->
          <div class="card">
           <div class="card-header">Consolidados</div>
           
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
              <a class="btn btn-sm btn-info" target="_blank" href="{{ route('pdf.general') }}" title="">pdf general</a>

              <a class="btn btn-sm btn-info" target="_blank" href="{{ route('pdf.general.comida') }}" title="">pdf general comida</a>

              <a class="btn btn-sm btn-info" target="_blank" href="{{ route('pdf.general.otro') }}" title="">pdf general productos</a>
            </div>
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
              <a class="btn btn-sm btn-info" target="_blank" href="{{ route('excel.general') }}" title="">excel general</a>

              <a class="btn btn-sm btn-info" target="_blank" href="{{ route('excel.general.comida') }}" title="">excel general comida</a>

              <a class="btn btn-sm btn-info" target="_blank" href="{{ route('excel.general.otro') }}" title="">excel general productos</a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!-- Table  -->
              <table id="tb" class="table table-hover">
                <!-- Table head -->
                <thead class="blue-grey lighten-4">
                  <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Inicial</th>
                    <th>Entradas</th>
                    <th>Salidas</th>
                    <th>Existencia</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <!-- Table head -->
                <!-- Table body -->
                <tbody>
                @forelse($productos as $producto)
                <tr>
                  <th scope="row">{{ $producto->id }}</th>
                  <td>{{ $producto->name }}</td>
                  <td>{{ $producto->quantity }}</td>
                  <td>{{ $producto->entrances()->count('quantity') }}/{{ $producto->entrances()->sum('quantity') }}</td>
                  <td>{{ $producto->deliverys()->count('quantity') }}/{{ $producto->deliverys()->sum('quantity') }}</td>
                  <td>{{ $producto->quantity+$producto->entrances()->sum('quantity')-$producto->deliverys()->sum('quantity') }}</td>
                  <td>
                      <a class="btn btn-sm" id="pdf" target="_blank" href="{{ route('pdf.producto_id',$producto->id) }}" title="Pdf con detalles del producto">PDF</a>
                      <a class="btn btn-sm" id="excel" target="_blank" href="{{ route('excel.producto_id',$producto->id) }}" title="Excel con detalles del producto">EXcEL</a>
                  </td>
                </tr>
                @empty
                <tr>
                <p>No hay productos para mostrar...</p>
                </tr>
                @endforelse
                </tbody>
                <!-- Table body -->
              </table>

            </div>

          </div>
          <!--/.Card-->
          <div class="card-footer">{{ $productos->render() }}</div>
        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->
  @section('my-js')
    <!-- Charts -->
    <script>

    // TODO
      $(document).ready(function(){

          var entradas_salidas = document.getElementById("entradas_salidas");
          var urlt = '{{ Route('consolidados.charts_entradas_salidas') }}';

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              type: 'get',
              url: urlt,
              success: function(data) {
                  Chart.defaults.global.defaultFontFamily = "Lato";
                  Chart.defaults.global.defaultFontSize = 18;

                  var entradasData = {
                    label: 'ENTRADAS',
                    data: data.entradas,
                    backgroundColor: 'rgba(0, 99, 132, 0.6)',
                    borderWidth: 0,
                    yAxisID: "y-axis-entradas"
                  };

                  var salidasData = {
                    label: 'SALIDAS',
                    data: data.salidas,
                    borderWidth: 0,
                    backgroundColor: 'rgba(99, 132, 0, 0.6)',
                    yAxisID: "y-axis-salidas"
                  };

                  var totalData = {
                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets: [entradasData, salidasData]
                  };

                  var chartOptions = {
                    scales: {
                      xAxes: [{
                        barPercentage: 1,
                        categoryPercentage: 0.6
                      }],

                      yAxes: [{
                        id: "y-axis-salidas",
                        scaleLabel: {
                          display: true,
                          labelString: 'Salidas'
                        }
                      }, {
                        id: "y-axis-entradas",
                        scaleLabel: {
                          display: true,
                          labelString: 'Entradas'
                        }
                      }]
                    }
                  };

                  var barChart = new Chart(entradas_salidas, {
                    type: 'bar',
                    data: totalData,
                    options: chartOptions
                  });
                  
              },
              error: function(data) {
                  var errors = data.responseJSON;
              }
          });
      });

    // TODO

    // TABLA
          function ver($id){
            console.log($id);
          }
    // TABLA

    </script>
    <!-- Charts -->
  @stop
@stop