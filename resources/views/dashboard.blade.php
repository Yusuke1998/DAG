@extends('template.layout')
@section('title') Direccion General de Administracion @stop
@section('content')
  <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-9 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <div class="card-body">

              <canvas id="myChart"></canvas>

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 mb-4">
            <!--Card-->
            <div class="card mb-4">
              <!--Card content-->
              <div class="card-body">

                <!-- List group links -->
                <div class="list-group list-group-flush">
                  <a class="list-group-item list-group-item-action waves-effect">Inicial
                    <span id="inicial" class="float-right badge badge-warning badge-pill pull-right"></span>
                  </a>
                  <a class="list-group-item list-group-item-action waves-effect">Entradas
                    <span id="entradas" class="float-right badge badge-success badge-pill pull-right"></span>
                  </a>
                  <a class="list-group-item list-group-item-action waves-effect">Salidas
                    <span id="salidas" class="float-right badge badge-danger badge-pill pull-right"></span>
                  </a>
                  <a class="list-group-item list-group-item-action waves-effect">Consolidado
                    <span id="consolidado" class="float-right badge badge-primary badge-pill pull-right"></span>
                  </a>
                </div>
                <!-- List group links -->
              </div>
            </div>
          <!--/.Card-->
        <!--Card-->
          <div class="card mb-4">
            <!--Card content-->
            <div class="card-body">
              <canvas id="pieChart"></canvas>
            </div>
          </div>
        <!--/.Card-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Card-->
          <div class="card">
      <div class="card-header">Entradas Recientes</div>
            <!--Card content-->
            <div class="card-body">

              <!-- Table  -->
              <table id="tabla_entradas" class="table table-hover">
                <!-- Table head -->
                <thead class="blue-grey lighten-4">
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                  </tr>
                </thead>
                <!-- Table head -->
              </table>
              <!-- Table  -->

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Card-->
          <div class="card">
      <div class="card-header">Salidas Recientes</div>
            <!--Card content-->
            <div class="card-body">

              <!-- Table  -->
              <table id="tabla_salidas" class="table table-hover">
                <!-- Table head -->
                <thead class="blue lighten-4">
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                  </tr>
                </thead>
                <!-- Table head -->
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
	    // Line
        var ctx = document.getElementById("myChart").getContext('2d');
        var url = '{{ Route('charts') }}';

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: 'get',
              url: url,
              success: function(data) {

	    var myChart = new Chart(ctx, {
	      type: 'bar',
	      data: {
	        labels: ["Inicial", "Entradas", "Salidas", "Existencia"],
	        datasets: [{
	          label: 'Estadisticas generales',
	          data: data,
	          backgroundColor: [
	            'rgba(255, 206, 86, 0.2)',
	            'rgba(54, 162, 235, 0.2)',
	            'rgba(255,99,132, 0.2)',
	            'rgba(75, 192, 192, 0.2)'
	          ],
	          borderColor: [
	            'rgba(255, 206, 86,1)',
	            'rgba(54, 162, 235, 1)',
	            'rgba(255, 206, 86, 1)',
	            'rgba(75, 192, 192, 1)'
	          ],
	          borderWidth: 1
	        }]
	      },
	      options: {
	        scales: {
	          yAxes: [{
	            ticks: {
	              beginAtZero: true
	            }
	          }]
	        }
          }
        });
    },
              error: function(data) {
                  var errors = data.responseJSON;
                  // alert('error');
              }
          });

	    //pie
          var ctxP = document.getElementById("pieChart").getContext('2d');

          var url = '{{ Route('charts') }}';

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              type: 'get',
              url: url,
              success: function(data) {
                var myPieChart = new Chart(ctxP, {
                  type: 'pie',
                  data: {
                    labels: ["Productos", "Entradas", "Salidas", "Existencia"],
                    datasets: [{
                      data: data,
                      backgroundColor: ["#ffcc00", "#00c851", "#ff3547", "#4285f4"],
                      hoverBackgroundColor: ["#ffaa00", "#009751", "#ff3560", "#4265f4"]
                    }]
                  },
                  options: {
                    responsive: true,
                    legend: false
                  }
                });
                  // console.log('success: '+data);
                  // alert('success'+data);
              },
              error: function(data) {
                  var errors = data.responseJSON;
                  // alert('error');
              }
          });

          $(document).ready(function(){
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: 'get',
                  url: url,
                  success: function(data) {
                    console.log(data);
                    $('#inicial').text(data[0]);
                    $('#entradas').text(data[1]);
                    $('#salidas').text(data[2]);
                    $('#consolidado').text(data[3]);
              },
                  error: function(data) {
                      var errors = data.responseJSON;
                      // alert('error');
                  }
              });
          });

          $(document).ready(function(){

            $('#tabla_entradas').DataTable({
              "serverSide":true,
              "ajax": "{{ route('ultimas_entradas') }}",
              "columns": [
                {data: 'product_id'},
                {data: 'quantity'},
                {data: 'date'},
              ]
            });

            $('#tabla_salidas').DataTable({
              "serverSide":true,
              "ajax": "{{ route('ultimas_salidas') }}",
              "columns": [
                {data: 'product_id'},
                {data: 'quantity'},
                {data: 'date'},
              ]
            });

          });

	  </script>
  	<!-- Charts -->
  @stop
@stop
