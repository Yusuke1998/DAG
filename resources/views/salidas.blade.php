@extends('template.layout')
@section('title') Direccion General de Administracion @stop
@section('content')
<!--Grid row-->
<div class="text-center">
<a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalnewdeliveries">Nueva salida</a>
</div>
<div class="row wow fadeIn">

<!--Grid column-->
<div class="col-md-12 mb-12">

<!--Card-->
<div class="card">
<div class="card-header">Salidas</div>
<!--Card content-->
<div class="card-body">

<!-- Table  -->
<table id="tb" class="table table-hover" cellspacing="0" width="100%">
<!-- Table head -->
<thead class="blue-grey lighten-4">
<tr>
<th>#</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Entregado por</th>
<th>Recibido por</th>
<th>Area</th>
<th>Comentario</th>
<th>Fecha</th>
<th scope="col">accion</th>
</tr>
</thead>
<!-- Table head -->

<!-- Table body -->
<tbody>
@forelse($salidas as $salida)
<tr>
<th scope="row">{{ $salida->id }}</th>
<td>{{ $salida->product->name }}</td>
<td>{{ $salida->quantity }}</td>
<td>{{ $salida->functionary_e }}</td>
<td>{{ $salida->functionary_r }}</td>
<td>{{ $salida->area->name }}</td>
<td>{{ $salida->commentary }}</td>
<td>{{ $salida->date }}</td>
<td>

<a class="btn btn-sm" href="#" data-toggle="modal" data-target="#modalupdatedeliveries" onclick="editar({{ $salida->id }});" title="">Editar</a>

<a class="btn btn-sm" id="eliminar" onclick="eliminar({{ $salida->id }});">Eliminar</a>
</td>
</tr>
@empty
<tr>
<p>No hay salidas...</p>
</tr>
@endforelse
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

<div class="modal fade" id="modalnewdeliveries" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form id="my_form" method="post">
{{ csrf_field() }}
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title w-100 font-weight-bold">Detalles de la salida</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body mx-3">
<div class="md-form mb-5">
<i class="fas fa-envelope prefix grey-text"></i>
<input type="text" id="functionary_e" name="functionary_e" class="form-control validate">
<label data-error="wrong" data-success="right" for="functionary_e">Entrega</label>
</div>
<div class="md-form mb-5">
<i class="fas fa-envelope prefix grey-text"></i>
<input type="text" id="functionary_r" name="functionary_r" class="form-control validate">
<label data-error="wrong" data-success="right" for="reception">Recibe</label>
</div>
<select class="browser-default custom-select" name="area_id">
<option selected disabled>Areas</option>
@foreach($areas as $area)
<option value="{{ $area->id }}">{{ $area->name }}</option>
@endforeach
</select>
<div class="md-form mb-4">
<i class="fas fa-lock prefix grey-text"></i>
<input type="number" name="quantity" id="quantity" class="form-control validate">
<label data-error="Error" data-success="Bien" for="orangeForm-pass">Cantidad</label>
</div>
<div class="md-form mb-4">
    {{-- <i class="fas fa-lock prefix grey-text"></i> --}}
    <input type="text" name="unity_m" id="unidadMedida" class="form-control validate">
    <label data-error="Error" data-success="Bien" for="unidadMedida">Presentacion</label>
  </div>
<div class="md-form mb-5">
<i class="fas fa-pencil-alt prefix"></i>
<textarea type="text" id="commentary" name="commentary" class="md-textarea form-control" rows="3"></textarea>
<label data-error="wrong" data-success="right" for="commentary">Comentario</label>
</div>
<select class="browser-default custom-select" name="product_id" id="product_id">
<option selected disabled>Productos</option>
@foreach($productos as $producto)
<option value="{{ $producto->id }}">{{ $producto->name }}</option>
@endforeach
</select>
<div class="md-form mb-5">
<input placeholder="Ingresa fecha" type="date" name="date" id="date-picker" class="form-control datepicker">
</div>
</div>
<div class="modal-footer d-flex justify-content-center">
<button id="esubmit" class="btn btn-default">Guardar</button>
</div>
</div>
</div>
</form>
</div>


<div class="modal fade" id="modalupdatedeliveries" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form id="my_form2" method="post">
{{ csrf_field() }}
<input type="hidden" name="_method" value="PUT">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title w-100 font-weight-bold">Detalles de la salida</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body mx-3">
<div class="md-form mb-5">
<i class="fas fa-envelope prefix grey-text"></i>
<input type="text" id="functionary_eu" name="functionary_e" class="form-control validate">
<label data-error="wrong" data-success="right" for="functionary_e">Entrega</label>
</div>
<div class="md-form mb-5">
<i class="fas fa-envelope prefix grey-text"></i>
<input type="text" id="functionary_ru" name="functionary_r" class="form-control validate">
<label data-error="wrong" data-success="right" for="reception">Recibe</label>
</div>
<select class="browser-default custom-select" id="area_idu" name="area_id">
<option selected disabled>Areas</option>
@foreach($areas as $area)
<option value="{{ $area->id }}">{{ $area->name }}</option>
@endforeach
</select>
<div class="md-form mb-4">
<i class="fas fa-lock prefix grey-text"></i>
<input type="number" name="quantity" id="quantityu" class="form-control validate">
<label data-error="Error" data-success="Bien" for="orangeForm-pass">Cantidad</label>
</div>
<div class="md-form mb-4">
    {{-- <i class="fas fa-lock prefix grey-text"></i> --}}
    <input type="text" name="unity_m" id="unidadMedidau" class="form-control validate">
    <label data-error="Error" data-success="Bien" for="unidadMedidau">Presentacion</label>
  </div>
<div class="md-form mb-5">
<i class="fas fa-pencil-alt prefix"></i>
<textarea type="text" id="commentaryu" name="commentary" class="md-textarea form-control" rows="3"></textarea>
<label data-error="wrong" data-success="right" for="commentaryu">Comentario</label>
</div>
<select class="browser-default custom-select" id="product_idu" name="product_id">
<option selected disabled>Productos</option>
@foreach($productos as $producto)
<option value="{{ $producto->id }}">{{ $producto->name }}</option>
@endforeach
</select>
<div class="md-form mb-5">
<input placeholder="Ingresa fecha" type="date" name="date" id="dateu" class="form-control datepicker">
</div>
</div>
<div class="modal-footer d-flex justify-content-center">
<button id="esubmit2" class="btn btn-default">Guardar</button>
</div>
</div>
</div>
</form>
</div>


@section('my-js')

<script type="text/javascript">
$('#esubmit').on('click', function(e){
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var form = $('#my_form').serialize();
    var url = '{{ Route('salidas.store') }}';
    var url2 = '{{ Route('salidas.cantidad') }}';

    var producto = $('#product_id').val();
    var cantidad = $('#quantity').val();

    $.ajax({
            type: 'post',
            url: url2,
            data: {"producto":producto},
            dataType: 'json',
            success: function(data) {
                    if (cantidad > data) {
                        alertify.warning("La cantidad no puede ser mayor a la total existe");
                    }else{
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: form,
                        dataType: 'json',
                        success: function(data) {
                                    $("#tb").load(" #tb");
                                    $('#modalnewdeliveries').modal('toggle');
                                    alertify.success("agregado con exito");
                                    console.log('success');
                                    console.log(data);
                        },
                        error: function(data) {
                                alertify.error("Fallo al agregar");
                            var errors = data.responseJSON;
                        }
                    });
                    }
            },
            error: function(data) {
                    alertify.error("Fallo al agregar");
                var errors = data.responseJSON;
            }
        });


});


function editar(id){

$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

var url2 = location.href+'/editar/'+id;

$.ajax({
    type: 'post',
    dataType: 'json',
    url: url2,
    success: function(data) {
            $('#functionary_eu').val(data.functionary_e)
            $('#functionary_ru').val(data.functionary_r)
            $('#quantityu').val(data.quantity)
            $('#unidadMedidau').val(data.unity_m)
            $('#commentaryu').val(data.commentary)
            $('#dateu').val(data.date)
            $('#product_idu').val(data.product_id)
            $('#area_idu').val(data.area_id)

            $('#esubmit2').on('click', function(e){
                e.preventDefault();
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formu = $('#my_form2').serialize();

            var url3 = location.href+'/'+id;

            console.log(url3);

            $.ajax({
                type: 'post',
                url: url3,
                data: formu,

                success: function(data) {
                    $("#tb").load("#tb");
                    $('#modalupdatedeliveries').modal('toggle');
                    alertify.success("Editado con exito");
                    console.log("success");
                },

                error: function(data) {
                    alertify.error("Valio");
                    console.log("Error");
                }
            });
        });
    },
    error: function(data) {
        alert('error');
    }
});

};


function eliminar(id){
      
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        var url4 = location.href+'/eliminar/'+id;

        $.ajax({
            type: "get",
            url: url4,
            success: function() { 
                // $("#tb").load("#tb");
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
