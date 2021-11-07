function cargarModelos() {
    $('#modeloBox').html(
       '<option disabled selected=inicial>Seleccione una Marca:</option>'
    );
    var marcaSeleccionada = document.getElementById("marcaBox").value;
    $.post(baseurl+"/cliente/obtenerModelosPorMarca/"+marcaSeleccionada,
        function (data) {
            var info = JSON.parse(data);

            $.each(info, function (i, item) {
                $('#modeloBox').append(
            '<option value="'+item.id+'">'+ item.nombre +' </option>'

                )

            })
        })
}