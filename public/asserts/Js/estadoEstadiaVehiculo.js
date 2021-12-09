function verEstadoEstadia() {
    console.log('entra1');
    var dominioSeleccionado = document.getElementById("dominio_vehiculo").value;

    $.post(baseurl + "/inspector/consultarEstadiaVehiculo/" + dominioSeleccionado,

        function (data) {
            console.log('data:' + data);
            var existeEstadia = JSON.parse(data);

            console.log('existe:' + existeEstadia);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            if (existeEstadia) {

                swalWithBootstrapButtons.fire({
                    text: 'No existe ninguna estadia activa registrada para el vehiculo seleccionado',
                    title: '¿Desea registrar una infraccion?',
                    'icon': 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then(result => {
                    console.log('d: '+dominioSeleccionado);
                    if (result.isConfirmed)
                        window.location.href = baseurl + "/inspector/verRegistrarInfraccion/" + dominioSeleccionado;

                });
            }else
                swalWithBootstrapButtons.fire({
                    text: 'Ya existe una estadia activa registrada para el vehiculo seleccionado',
                    showCancelButton: true,
                    cancelButtonText: 'Salir',
                    showConfirmButton: false,

                }).then(result => {
                    if (result.isConfirmed)
                        window.location.href = baseurl ;

                });
        })
}

