$('#bsubmit').on('click', function(e){
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var form = $('#my_form').serialize();
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
   // alert(location.href+'/editar/'+id)
   // var url2 = '{{ Route('productos.ajax_editar',$producto->id) }}';
    var url2 = location.href+'/editar/'+id;
    //console.log(id);
    //console.log(url2);
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
            console.log(/*'success: '+*/data);
            // alert('error');
        },
        error: function(data) {
            var errors = data.responseJSON;
            // alert('success');
        }
    });


};
