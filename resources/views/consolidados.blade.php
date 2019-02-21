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
            <!--Card content-->
            <div class="card-body">

              <!-- Table  -->
              <table class="table table-hover">
                <!-- Table head -->
                <thead class="blue-grey lighten-4">
                  <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Entradas</th>
                    <th>Salidas</th>
                    <th>Existencias</th>
                  </tr>
                </thead>
                <!-- Table head -->

                <!-- Table body -->
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Cell 1</td>
                    <td>Cell 2</td>
                    <td>Cell 3</td>
                    <td>Cell 3</td>
                  </tr>
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
    <!-- Charts -->
    <script>

          // TODO

          var entradas_salidas = document.getElementById("entradas_salidas");
          var urlt = '{{ Route('consolidados.charts_entradas_salidas') }}';
          // console.log(entradas_salidas);
          console.log(urlt);

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

                  console.log(data.entradas);
                  console.log(data.salidas);

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

          // TODO

          // DATATABLE SERVER SIDE

          

          // DATATABLE SERVER SIDE

    </script>
    <!-- Charts -->
  @stop
@stop