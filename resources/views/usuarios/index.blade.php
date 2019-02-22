@extends('template.layout')
@section('title') Administrar usuarios @stop
@section('content')
<div class="container">

  <div class="row">
    <div class="col">
      	<table id="user_table" class="table">
		  <thead class="black white-text">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Usuario</th>
		      <th scope="col">Correo electronico</th>
		      <th scope="col">Tipo</th>
		      <th scope="col">Opcion</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($usuarios as $usuario)
		    <tr>
		      <td scope="col">{{ $usuario->id }}</td>
		      <td>{{ $usuario->name }}</td>
		      <td>{{ $usuario->email }}</td>
		      <td>{{ $usuario->type }}</td>
		      <td>
		      	{{-- <a class="btn btn-info btn-sm" onclick="editar({{$usuario->id}})">Editar</a> --}}
		      	<a class="" onclick="eliminar({{$usuario->id}})">Eliminar</a>
		      </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
    </div>
    <div class="col">
      algo ahi!
    </div>
  </div>
</div>
@section('my-js')
<script>

// $(document).ready(function() {
//     $('#user_table').DataTable( {
//         "processing": true,
//         "serverSide": true,
//         "ajax": "",
//   		"columns": [
//             { "data": "id" },
//             { "data": "name" },
//             { "data": "email" },
//             { "data": "type" },
//         ]
//     });
// });

// function editar(id){
// 	console.log(id);
// }

function eliminar(id){
      
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        var url2 = location.href+'/eliminar/'+id;
        console.log(url2);

        $.ajax({
            type: "get",
            url: url2,
            success: function() { 
                $("#user_table").load("#user_table");
                console.log("Success");
                alertify.success("Eliminado con exito");

            },error: function(){
                console.log("Error");
                alertify.error("Error al eliminar");
            }
        });

    };

</script>
@stop

@stop