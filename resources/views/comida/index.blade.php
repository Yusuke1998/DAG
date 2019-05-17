@extends('template.layout')
@section('title') Comida @stop
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
				      <th scope="col">Tipo</th>
				      <th scope="col">Presentación</th>
				      <th scope="col">Cantidad</th>
				      <th scope="col">accion</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($comidas as $comida)
				    <tr>
                      <th>{{ $comida->id }}</th>
				      <td>{{ $comida->code }}</td>
				      <td>{{ $comida->name }}</td>
				      <td>{{ $comida->type }}</td>
				      <td>{{ $comida->unity_m }}</td>
				      <td>{{ $comida->quantity }}</td>

				      <td>
				      		<a class="btn btn-sm" data-toggle="modal" data-target="#updateModal" onclick="editarP({{ $comida->id }});" title="">Editar</a>

				      		<a class="btn btn-sm" id="eliminar" href="{{ Route('comida.destroy',$comida->id) }}" title="">Eliminar</a>
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
	<form action="{{ route('comida.store') }}" method="post" id="my_form">
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
	          {{-- <i class="fas fa-user prefix grey-text"></i> --}}
	          <input type="number" name="code" id="codigo" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="codigo">Codigo</label>
	        </div>
	        <div class="md-form mb-5">
	         {{--  <i class="fas fa-envelope prefix grey-text"></i> --}}
	          <input type="text" name="name" id="nombre" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="nombre">Nombre</label>
	        </div>
	        <div class="md-form mb-5">
	          <select type="text" name="type" id="tipo" class="form-control validate">
	          		<option selected disabled value="Comida">Comida</option>
	          </select>
	          {{-- <label data-error="Error" data-success="Bien" for="orangeForm-email">Tipo</label> --}}
			</div>
	        <div class="md-form mb-5">
	         {{--  <i class="fas fa-envelope prefix grey-text"></i> --}}
	          <input type="text" name="supplier" id="proveedor" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="proveedor">Proveedor</label>
	        </div>
	        <div class="md-form mb-5">
	         {{--  <i class="fas fa-envelope prefix grey-text"></i> --}}
	          <input type="text" name="price" id="precio" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="precio">Precio</label>
	        </div>

	        <div class="md-form mb-4">
	          {{-- <i class="fas fa-lock prefix grey-text"></i> --}}
	          <input type="text" name="description" id="descripcion" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="descripcion">Descripcion</label>
	        </div>

            <div class="md-form mb-4">
	          {{-- <i class="fas fa-lock prefix grey-text"></i> --}}
	          <input type="number" name="quantity" id="quantity" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="quantity">Cantidad</label>
					</div>

					<div class="md-form mb-4">
	          {{-- <i class="fas fa-lock prefix grey-text"></i> --}}
	          <input type="text" name="unity_m" id="unidadMedida" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="unidadMedida">Presentacion</label>
	        </div>

	          <label data-error="Error" data-success="Bien" for="fechaV">F.Vencimiento</label>
	        	<div class="md-form mb-4">
	          {{-- <i class="fas fa-lock prefix grey-text"></i> --}}
	          		<input type="date" id="fechaV" name="date_maturity" class="form-control validate">
	        	</div>
	          <label data-error="Error" data-success="Bien" for="fechaC">F.Compra</label>
	        	<div class="md-form mb-4">
	          {{-- <i class="fas fa-lock prefix grey-text"></i> --}}
	          		<input type="date" id="fechaC" autofocus="true" name="date" class="form-control validate">
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
	<form method="post" id="my_form_u">
	{{-- enctype='multipart/form-data' --}}
	{{ csrf_field() }}
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title w-100" id="myModalLabelu">Editar producto</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body mx-3">
	        <div class="md-form mb-5">
	          <input type="hidden" name="_method" value="PUT">
	          <input type="number" name="code" id="codigou" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-name">Codigo</label>
	        </div>
	        <div class="md-form mb-5">
	          <input type="text" name="name" id="nombreu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="nombreu">Nombre</label>
			</div>
			<div class="md-form mb-5">
	          <select type="text" name="type" id="tipou" class="browser-default custom-select">
	          		<option selected disabled value="Comida">Comida</option>
	          </select>
			</div>
			<div class="md-form mb-5">
	          <input type="text" name="supplier" id="proveedoru" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="proveedor">Proveedor</label>
	        </div>
	        <div class="md-form mb-5">
	          <input type="text" name="price" id="preciou" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="precio">Precio</label>
	        </div>

	        <div class="md-form mb-4">
	          <input type="text" name="description" id="descripcionu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Descripcion</label>
			</div>

			<div class="md-form mb-4">
	          <input type="text" name="unity_m" id="unidadMedidau" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="unidadMedidau">Presentacion</label>
	        </div>

            <div class="md-form mb-4">
	          <input type="number" name="quantity" id="quantityu" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="quantityu">Cantidad</label>
	        </div>

	        <div class="md-form mb-4">
	          <input type="date" id="fechaVu" name="date_maturity" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="fechaVu">F.Vencimiento</label>
			</div>

			<div class="md-form mb-4">
	          <input type="date" id="fechaCu" name="date" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="fechaCu">F.Compra</label>
			</div>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
	        <button type="button" id="bsubmitu" class="btn btn-primary btn-sm">Actualizar</button>
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
		    var url = '{{ Route('comida.store') }}';
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
		        },
		        error: function(data) {
                    alertify.error("Fallo al agregar");
		            var errors = data.responseJSON;
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
		        type: 'get',
		        url: url2,
		        success: function(data) {
                    $('#codigou').val(data.code);
                    $('#nombreu').val(data.name);
                    $('#tipou').val(data.type);
                    $('#proveedoru').val(data.supplier);
                    $('#preciou').val(data.price);
                    $('#descripcionu').val(data.description);
                    $('#unidadMedidau').val(data.unity_m);
                    $('#quantityu').val(data.quantity);
                    $('#fechaVu').val(data.date_maturity);
                    $('#fechaCu').val(data.date);
				   
				    $('#bsubmitu').on('click', function(e){  
				        e.preventDefault();
					    $.ajaxSetup({
	                        headers: {
	                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                        }
                        });
		                var my_form_u = $('#my_form_u').serialize();
		                // var urlu = window.location.href+'/'+id;
            			var urlu = location.href+'/actualizar/'+id;

            			console.log(urlu);
		                $.ajax({
		                    type: 'post',
		                    url: urlu,
		                    data: my_form_u,
				        	dataType: 'JSON',
		                    success: function(data) {
		                    	console.log('ajax success');
		                        $("#tb").load(" #tb");
		                        $('#updateModal').modal('toggle');
		                        // alertify.error("Error en edicion!");
		                        alertify.success("Editado con exito!");
		                    },
		                    error: function() {
		                    	console.log('ajax error');
		                        $("#tb").load(" #tb");
		                        $('#updateModal').modal('toggle');
		                        alertify.success("Editado con exito!");
		                    }
		                });
		            });
		        },
		        error: function(data) {
		            var errors = data.responseJSON;
		        }
		    });
		};
	</script>

	@stop
@stop
