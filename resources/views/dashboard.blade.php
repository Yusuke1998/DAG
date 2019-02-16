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
                  <a class="list-group-item list-group-item-action waves-effect">Productos
                    <span class="badge badge-success badge-pill pull-right">22%</span>
                  </a>
                  <a class="list-group-item list-group-item-action waves-effect">Entradas
                    <span class="badge badge-danger badge-pill pull-right">5%</span>
                  </a>
                  <a class="list-group-item list-group-item-action waves-effect">Salidas
                    <span class="badge badge-primary badge-pill pull-right">14%</span>
                  </a>
                </div>
                <!-- List group links -->
              </div>
            </div>
          <!--/.Card-->
        <!--Card-->
          <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header text-center">
              Pie chart
            </div>
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
              <table class="table table-hover">
                <!-- Table head -->
                <thead class="blue-grey lighten-4">
                  <tr>
                    <th>#</th>
                    <th>Lorem</th>
                    <th>Ipsum</th>
                    <th>Dolor</th>
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
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Cell 4</td>
                    <td>Cell 5</td>
                    <td>Cell 6</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Cell 7</td>
                    <td>Cell 8</td>
                    <td>Cell 9</td>
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

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Card-->
          <div class="card">
      <div class="card-header">Salidas Recientes</div>
            <!--Card content-->
            <div class="card-body">

              <!-- Table  -->
              <table class="table table-hover">
                <!-- Table head -->
                <thead class="blue lighten-4">
                  <tr>
                    <th>#</th>
                    <th>Lorem</th>
                    <th>Ipsum</th>
                    <th>Dolor</th>
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
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Cell 4</td>
                    <td>Cell 5</td>
                    <td>Cell 6</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Cell 7</td>
                    <td>Cell 8</td>
                    <td>Cell 9</td>
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
	        labels: ["Inicial", "Endtradas", "Salidas", "Existencia"],
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
                    labels: ["Productos", "Entradas", "Salidas"],
                    datasets: [{
                      data: data,
                      backgroundColor: ["#ff3547", "#00c851", "#4285f4"],
                      hoverBackgroundColor: ["#ff3560", "#009751", "#4265f4"]
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

	  </script>
  	<!-- Charts -->
  @stop
@stop
