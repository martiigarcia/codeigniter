function cargarZonas() {
    $('#hZona').html(
        ' <option disabled selected=inicial>Seleccione el horario de la zona a modificar:</option>'
    );
    var zonaSeleccionada = document.getElementById("idZona").value;
    $.post(baseurl+"/administrador/obtenerHistoralZona/"+zonaSeleccionada,
        function (data) {
        console.log(1)
            var info = JSON.parse(data);

            $.each(info, function (i, item) {
                $('#hZona').append(
                    '<option value="'+item.id+'">inicio: ' + item.comienzo +' finalizaion: '+item.final+' </option>'

                )

            })
        })
}