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
              <canvas id="entradas" width="600" height="400"></canvas>
            </div>              
          </div>
        </div>
        <div class="col-md-12 mb-12">
          <div class="card">
            <div class="card-header">Graficas</div>
            <div class="card-body">
              <canvas id="salidas" width="600" height="400"></canvas>
            </div>
              
            </div>
          </div>

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

      //Entradas
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          var entradas = document.getElementById("entradas");
          var urle = '{{ Route('consolidados.charts_entradas') }}';

          $.ajax({
              type: 'get',
              url: urle,
              success: function(data) {
                  console.log(data);
                  Chart.defaults.global.defaultFontFamily = "Lato";
                  Chart.defaults.global.defaultFontSize = 18;
                  var densityData = {
                    label: 'GRAFICA GENERAL DE ENTRADAS',
                    data:data
                  };

                  var barChart = new Chart(entradas, {
                    type: 'bar',
                    data: {
                      labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                      datasets: [densityData]
                    }
                  });
              },
              error: function(data) {
                  var errors = data.responseJSON;
              }
          });


          // salidas
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          var salidas = document.getElementById("salidas");
          var urls = '{{ Route('consolidados.charts_salidas') }}';

          $.ajax({
              type: 'get',
              url: urls,
              success: function(data) {
                  console.log(data);
                  Chart.defaults.global.defaultFontFamily = "Lato";
                  Chart.defaults.global.defaultFontSize = 18;
                  var densityData = {
                    label: 'GRAFICA GENERAL DE SALIDAS',
                    data:data
                  };

                  var barChart = new Chart(salidas, {
                    type: 'bar',
                    data: {
                      labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                      datasets: [densityData]
                    }
                  });
              },
              error: function(data) {
                  var errors = data.responseJSON;
              }
          });





          // $.ajaxSetup({
          //     headers: {
          //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          //     }
          // });
          // $.ajax({
          //     type: 'get',
          //     url: url,
          //     success: function(data) {
          //       console.log(data);
          //       $('#inicial').text(data[0]);
          //       $('#entradas').text(data[1]);
          //       $('#salidas').text(data[2]);
          //       $('#consolidado').text(data[3]);
          // },
          //     error: function(data) {
          //         var errors = data.responseJSON;
          //         // alert('error');
          //     }
          // });

    </script>
    <!-- Charts -->
  @stop
@stop