@extends('template.layout')
@section('title') Productos @stop
@section('content')
	<div class="container">
		<div class="row">
		    <div class="col">
		      <!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">Nuevo</button>

			    <table id="dtBasicExample" class="table table-striped table-bordered dtBasicExample" cellspacing="0" width="100%">
				  <thead class="black white-text">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Codigo</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Unidad de Medida</th>
				      <th scope="col">accion</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				    @foreach($productos as $producto)
				      <td>{{ $producto->code }}</td>
				      <th>{{ $producto->id }}</th>
				      <td>{{ $producto->name }}</td>
				      <td>{{ $producto->unity_m }}</td>
				      <td>
				      		<a class="btn btn-sm" href="{{ Route('productos.show',$producto->id) }}" title="">Ver</a>
				      		<a class="btn btn-sm" href="{{ Route('productos.editar',$producto->id) }}" title="">Editar</a>
				      		<a class="btn btn-sm" href="{{ Route('productos.eliminar',$producto->id) }}" title="">Eliminar</a>
				      </td>
				    @endforeach
				    </tr>
				  </tbody>
				</table>		      
		    </div>
		</div>
	</div>

	<!-- Central Modal Small -->
	<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	  aria-hidden="true">

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
	          <input type="number" id="codigo" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-name">Codigo</label>
	        </div>
	        <div class="md-form mb-5">
	          <i class="fas fa-envelope prefix grey-text"></i>
	          <input type="text" id="nombre" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-email">Nombre</label>
	        </div>

	        <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="text" id="descripcion" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Descripcion</label>
	        </div>

	        <div class="md-form mb-4">
	          	<select id="unidadMedida" class="custom-select">
				  <option value="" disabled selected>Unidad de medida</option>
				  <option value="1">One</option>
				  <option value="2">Two</option>
				  <option value="3">Three</option>
				</select>
	        </div>

	        <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="text" id="fechaV" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Fecha de vencimiento</label>
	        </div>

	        <div class="md-form mb-4">
	          <i class="fas fa-lock prefix grey-text"></i>
	          <input type="text" id="imagen" class="form-control validate">
	          <label data-error="Error" data-success="Bien" for="orangeForm-pass">Imagen</label>
	        </div>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
	        <button type="button" id="bsubmit" class="btn btn-primary btn-sm">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Central Modal Small -->

	@section('my-js')
	<script type="text/javascript">

		$(document).ready(function () {
		  $('.dtBasicExample').DataTable();
		  $('.dataTables_length').addClass('bs-select');
		// Material Select Initialization
		  $('#mdb-select').materialSelect();
		});

	</script>
	@stop
@stop