// function cargarTabla() {
//     $('#tableUsuarios').html(
//         '<thead>' +
//         '<tr class="table-success">' +
//         '<th>DNI</th>' +
//         '<th>Nombre</th>' +
//         '<th>Apellido</th>' +
//         '<th>Fecha de nacimiento</th>' +
//         '<th>Email</th>' +
//         '<th>Rol</th>' +
//         '<th>Opciones</th>' +
//         ' </tr>' +
//         '</thead>'
//     );
//
//     $.post(baseurl+"/home/cargarTabla",
//         function (data) {
//             var info = JSON.parse(data);
//
//             $.each(info, function (i, item) {
//
//
//                 $('#tableUsuarios').append(
//                     '<tbody>' +
//                     '<tr>' +
//                     '<td>' + item.DNI + '</td>' +
//                     '<td>' + item.nombre + '</td>' +
//                     '<td>' + item.apellido + '</td>' +
//                     '<td>' + item.fecha_de_nacimiento + '</td>' +
//                     '<td>' + item.email + '</td>' +
//                     '<td>' + item.rol_nombre + '</td>' +
//                     '<td>' +
//                     '<a href="' + baseurl+'/home/editar/'+item.id + '" class="btn btn-outline-warning bt-sm ">' +
//                     '<i class="bi bi-pencil-square"></i></a>' +
//
//                     '<a style="margin-left:10px" onclick="return mensajeEliminado(' + baseurl+"/home/eliminar/"+item.id + ')" class="btn btn-outline-danger bt-sm  ">' +
//                     '<i class="bi bi-trash"></i>' +
//                     '</a>' +
//
//                     '</td>' +
//                     '</tr>' +
//                     '</tbody>'
//                 )
//
//             })
//         })
// }
$(document).ready(function () {
    $('#tableUsuarios').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron coincidencias",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay contenido que mostrar",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }

        }
    });
});
