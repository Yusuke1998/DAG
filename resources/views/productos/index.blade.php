@extends('template.layout')
@section('title') Productos @stop
@section('content')
	<div class="container">
		<div class="row">
		    <div class="col">
		      <center><p style="padding-top: 10px;" class="h5">Todos los productos</p></center>
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
	@section('my-js')
	<script type="text/javascript">

		$(document).ready(function () {
		  $('.dtBasicExample').DataTable();

		  // $('.dtBasicExample').DataTable({
		  // 	"serverSide": true,
		  // 	"ajax": " {{ url('inventario/usuarios') }} ",
		  // 	"columns": [
		  // 		{data: 'id'},
		  // 		{data: 'name'},
		  // 	]
		  // });

		  $('.dataTables_length').addClass('bs-select');
		});

	</script>
	@stop
@stop