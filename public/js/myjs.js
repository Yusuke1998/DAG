$(document).ready(function() {
    $('#bsubmit').click(function(e){
        var codigo=$("#codigo").val();
        var nombre=$("#nombre").val();
        var descripcion=$("#descripcion").val();
        var unidadMedida=$("#unidadMedida").val();
        var cantidad=$("#cantidad").val();
        var fechaV=$("#fechaV").val();
        var imagen=$("#imagen").val();
        console.log(codigo);

        $.ajax
        ({
            url:'productos',
            type:'post',
            dataType:'json',
            data:{'code':codigo,
                  'name': nombre,
                  'description': descripcion,
                  'unity_m': unidadMedida,
                  'quantity': cantidad,
                  'date_maturity': fechaV,
                  'image': imagen,
                },


            success: function (data)
            {
                alert("Se ha realizado el POST con exito "+msg);
            }


        });

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
    })
  })
