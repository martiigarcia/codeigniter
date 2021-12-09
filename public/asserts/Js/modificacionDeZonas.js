function cargarHorasZonas() {
    $('#hZona').html(
        ' <option disabled selected=inicial>Seleccione el horario de la zona a modificar:</option>'
    );
    var zonaSeleccionada = document.getElementById("idZona").value;
    $.post(baseurl+"/administrador/obtenerHistoralZona/"+zonaSeleccionada,
        function (data) {

            var info = JSON.parse(data);

            $.each(info, function (i, item) {
                $('#hZona').append(
                    '<option value="'+item.id+'">inicio: ' + item.comienzo +' finalizaion: '+item.final+' </option>'

                )
            })
        })
}
function cargarHoraYPrecioZonas() {
    $('#hZona').html(
        ' <option disabled selected=inicial>Seleccione el horario y precio de la zona a modificar:</option>'
    );
    var zonaSeleccionada = document.getElementById("idZona").value;
    $.post(baseurl+"/administrador/obtenerHistoralZona/"+zonaSeleccionada,
        function (data) {

            var info = JSON.parse(data);

            $.each(info, function (i, item) {
                $('#hZona').append(
                    '<option value="'+item.id+'">inicio: ' + item.comienzo +' finalizaion: '+item.final+' Precio actual: '+item.precio+' </option>'

                )

            })
        })
}

function cargarHorasZonasParaMultas() {
    $('#hZona').html(
        ' <option disabled selected=inicial>Seleccione el horario de la zona a modificar:</option>'
    );
    var zonaSeleccionada = document.getElementById("idZona").value;

    $.post(baseurl+"/inspector/obtenerHistoralZona/"+zonaSeleccionada,
        function (data) {

            console.log(data);
            var info = JSON.parse(data);

            $.each(info, function (i, item) {
                $('#hZona').append(
                    '<option value="'+item.id+'">inicio: ' + item.comienzo +' finalizaion: '+item.final+' </option>'

                )
            })
        })
}

