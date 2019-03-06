@extends('template.layout')
@section('title') Administrar usuarios @stop
@section('content')
<div class="container">

  <div class="row">
    <div id="all-users" class="col">
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
                @if($usuario->id==1)
		      	<a class="btn btn-info btn-sm" onclick="eliminar({{$usuario->id}})" style='display:none;'>Eliminar</a>
                @endif
                @if($usuario->id!=1)
		      	<a class="btn btn-info btn-sm" onclick="eliminar({{$usuario->id}})">Eliminar</a>
                @endif
		      </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
    </div>
    <div class="col">
    <form id="my_form" method="post">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Nuevo Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <input type="text" id="name" name="name" class="form-control validate">
                <label data-error="wrong" data-success="right" for="reception">Nombre</label>
              </div>
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <input type="email" id="email" name="email" class="form-control validate">
                <label data-error="wrong" data-success="right" for="reception">Email</label>
              </div>
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <input type="password" id="password" name="password" class="form-control validate">
                <label data-error="wrong" data-success="right" for="reception">Contraseña</label>
              </div>
              <select class="browser-default custom-select" name="type">
              <option value="" disabled selected>Tipo de Usuario</option>
				  <option value="administrador">administrador</option>
				  <option value="consultor">consultor</option>

              </select>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button id="esubmit" class="btn btn-default">Guardar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@section('my-js')
<script>

$('#esubmit').on('click', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var form = $('#my_form').serialize();
        var url = '{{ Route('usuarios.store') }}';

        console.log(form);
        console.log(url);

        $.ajax({
            type: 'post',
            url: url,
            data: form,
            dataType: 'json',
            success: function(data) {
                    alertify.success("agregado con exito");
                    console.log('success');
                    console.log(data);
                    $("#all-users").load(" #all-users");
            },
            error: function(data) {
                    alertify.error("Fallo al agregar");
                    var errors = data.responseJSON;
            }
        });
    });

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
                $("#all-users").load(" #all-users");
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
