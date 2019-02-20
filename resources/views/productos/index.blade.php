@extends('template.layout')
@section('title') Productos @stop
@section('content')
	<div class="container">
		<div class="row">
		    <div class="col">
		      <!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Nuevo</button>

			    <table id="tb" class="table table-striped table-bordered tb" cellspacing="0" width="100%">
				  <thead class="black white-text">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Codigo</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Unidad de Medida</th>
				      <th scope="col">Cantidad</th>
				      <th scope="col">accion</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($productos as $producto)
				    <tr>
                      <th>{{ $producto->id }}</th>
				      <td>{{ $producto->code }}</td>
				      <td>{{ $producto->name }}</td>
				      <td>{{ $producto->unity_m }}</td>
				      <td>{{ $producto->quantity }}</td>

				      <td>
				      		<a class="btn btn-sm" id="mostrar" href="{{ Route('productos.show',$producto->id) }}" title="">Ver</a>

                            <a class="btn btn-sm" href="#" data-toggle="modal" data-target="#entranceModal" onclick="entradaP({{ $producto->id }});" title="">Entradas</a>

                            <a class="btn btn-sm" href="#" data-toggle="modal" data-target="#deliveryModal" onclick="salidaP({{ $producto->id }});" title="">Salidas</a>

				      		<a class="btn btn-sm" href="#" data-toggle="modal" data-target="#updateModal" onclick="editarP({{ $producto->id }});" title="">Editar</a>

				      		<a class="btn btn-sm" id="eliminar" href="{{ Route('productos.eliminar',$producto->id) }}" title="">Eliminar</a>
				      </td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>

		    </div>
		</div>
	</div>

<!-- Central Modal Small -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	  aria-hidden="true">
	<form action="{{ route('productos.store') }}" method="post" id="my_form">
	{{-- enctype='multipart/form-data' --}}
	{{ csrf_field() }}
	  <!-- Change class .modal-sm to change the size of the modal -->
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title w-100" id="myModalLabel">Nuevo producto</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body mx-3">
	        <div class="md-form mb-5">
	          <i class="fas fa-user prefix grey-text"></i>
	          <input type="number" name="code" id="codigo" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-name">Codigo</label>
	        </div>
	        <div class="md-form mb-5">
	          <i class="fas fa-envelope prefix grey-text"></i>
	          <input type="text" name="name" id="nombre" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-email">Nombre</label>
	        </div>

	        <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="text" name="description" id="descripcion" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Descripcion</label>
	        </div>

	        <div class="md-form mb-4">
	          	<select id="unidadMedida" name="unity_m" class="custom-select">
				  <option value="" disabled selected>Unidad de medida</option>
				  <option value="1">GRM</option>
				  <option value="2">KG</option>
				  <option value="3">TN</option>
				</select>
	        </div>
            <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="number" name="quantity" id="quantity" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Cantidad</label>
	        </div>

	        <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="date" id="fechaV" name="date_maturity" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass"></label>
	        </div>

	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
	        <button type="button" id="bsubmit" class="btn btn-primary btn-sm">Guardar</button>
	      </div>
	    </div>
	  </div>
	</form>
</div>
    <!-- Central Modal Small -->

<!-- Central Modal Update -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	  aria-hidden="true">
	<form action="location.href+'/editar/'+id;" method="post" id="my_formu">
	{{-- enctype='multipart/form-data' --}}
	{{ csrf_field() }}
	  <!-- Change class .modal-sm to change the size of the modal -->
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title w-100" id="myModalLabelu">Editar entrada</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body mx-3">
	        <div class="md-form mb-5">
	          <i class="fas fa-user prefix grey-text"></i>
	          <input type="number" name="code" id="codigou" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-name">Codigo</label>
	        </div>
	        <div class="md-form mb-5">
	          <i class="fas fa-envelope prefix grey-text"></i>
	          <input type="text" name="name" id="nombreu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-email">Nombre</label>
	        </div>

	        <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="text" name="description" id="descripcionu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Descripcion</label>
	        </div>

	        <div class="md-form mb-4">
	          	<select id="unidadMedidau" name="unity_mu" class="custom-select">
				  <option value="" disabled selected>Unidad de medida</option>
				  <option value="1">GRM</option>
				  <option value="2">KG</option>
				  <option value="3">TN</option>
				</select>
	        </div>
            <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="number" name="quantity" id="quantityu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Cantidad</label>
              <input type="hidden" name="_method" value="PUT">
	        </div>

	        <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="date" id="date_maturityu" name="date_maturityu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass"></label>
	        </div>

	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
	        <button type="button" id="bsubmitu" class="btn btn-primary btn-sm">Guardar</button>
	      </div>
	    </div>
	  </div>
	</form>
</div>
	<!-- Central Modal Update -->

	@section('my-js')

	<script>

		$('#bsubmit').on('click', function(e){
    		e.preventDefault();

    		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

            var form = $('#my_form').serialize();
            console.log(form);
		    // var form = $('#my_form').FormData();
		    var url = '{{ Route('productos.store') }}';
		    // var parametros = new FormData(this);

		    $.ajax({
		        type: 'post',
		        url: url,
		        data: form,
		        dataType: 'json',
		        success: function(data) {
                        $("#tb").load(" #tb");
                        $('#createModal').modal('toggle');
                        alertify.success("agregado con exito");
    		            console.log('success: '+data);

		            // alert('error');
		        },
		        error: function(data) {
                    alertify.error("Fallo al agregar");
		            var errors = data.responseJSON;
		            // alert('success');
		        }
		    });
		});


		function editarP(id){
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
            });
            var url2 = location.href+'/editar/'+id;
		    $.ajax({
		        type: 'post',
		        url: url2,
		        success: function(data) {
                    $('#codigou').val(data.code)
                    $('#nombreu').val(data.name)
                    $('#descripcionu').val(data.description)
                    $('#unidadMedidau').val(data.unity_m)
                    $('#quantityu').val(data.quantity)
                    $('#date_maturityu').val(data.date_maturity)
                    console.log(data);

                    $('#bsubmitu').on('click', function(e){
                        $.ajaxSetup({
		                    headers: {
		                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                    }
                        });
                        console.log("funciona");
                        var formu = $('#my_formu').serialize();
                        var url3 = location.href+'/'+id;
                        console.log(formu);


                        $.ajax({
                            type: 'post',
		                    url: url3,
		                    data: formu,
		                    success: function(data) {
                                alert('aqui');
                                console.log(data);
                                $("#tb").load(" #tb");
                                $('#updateModal').modal('toggle');
                                alertify.error("agregado con exito");

                            },
                            error: function(data) {
                                $("#tb").load(" #tb");
                                $('#updateModal').modal('toggle');
                                alertify.success("agregado con exito");
		                        console.log(data);
		                        // alert('success');
		                    }

                        });
                    });


		                    // alert('error');
		        },
		        error: function(data) {
		            var errors = data.responseJSON;
		            // alert('success');
		        }
		    });


		};


		function entradaP(id){

            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
            });

            var urle = location.href+'/entradas/'+id;

            console.log(urle); 
		    $.ajax({
		        type: 'get',
		        url: urle,
		        dataType: 'json',
		        success: function(data) {
                    console.log(data);
		            // alert('success');
		        },
		        error: function(data) {
                    console.log(data);
		            // alert('error');
		        }
		    });
		};

		function salidaP(id){

            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
            });

            var urls = location.href+'/salidas/'+id;

            console.log(urls); 
		    $.ajax({
		        type: 'get',
		        url: urls,
		        dataType: 'json',
		        success: function(data) {
                    console.log(data);
		            // alert('success');
		        },
		        error: function(data) {
                    console.log(data);
		            // alert('error');
		        }
		    });
		};


	</script>

	@stop
@stop
