document.addEventListener('DOMContentLoaded', function () {
    /**********cargar unidades en mantenimiento en la tabla**********/
    if(document.querySelector('#tableDataMant')){
        $('#tableDataMant').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            pageLength: 50,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible",
                "sInfo": "Total de _TOTAL_ Registros",
                "sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "ajax": {
                "url": ' ' + base_url + 'Datamant/listDataMant',
                "dataType":'json',
                "dataSrc": ''
            },
            "columns": [
                { 'data': 'id_unidad' },
                { 'data': 'fecha_entrada' },
                { 'data': 'fecha_salida' },
                { 'data': 'diagnostico' },
                { 'data': 'recomendacion' },
                { 'data': 'user_nombres' },
                { 'data': 'opciones' }
            ],
            paging: false,
            scrollCollapse: true,
            scrollY: '50vh',
            dom: 'Bfrtip',
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tableDataMant_wrapper .col-sm-6:eq(0)')
    }
})
fntDelReg = (idUnidadMantenimiento) => {
    Swal.fire({
        title: 'Estas seguro de eliminar el registro ?',
        text: "No podra ser revertido el proceso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'btn btn-success',
        cancelButtonColor: 'btn btn-danger',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            //usando un if reducido creamos un objeto del contenido en (request)
            let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
            let ajaxUrl = base_url + 'Datamant/delreg/' + idUnidadMantenimiento 
            //prepara los datos por ajax preparando el dom
            request.open('POST', ajaxUrl, true)
            //envio de datos del formulario que se almacena enla variable
            request.send()
            //despues del envio retornamos una funcion con los datos
            request.onreadystatechange = function () {
                //validamos la respuesta del servidor al enviar los datos
                if (request.readyState == 4 && request.status == 200) {
                    //obtener el json y convertirlo a un objeto en javascript
                    var objData = JSON.parse(request.responseText)
                    //condionamos la respuesta del array del controlador
                    if (objData.status) {
                        notifi(objData.msg, 'success')
                        let tableDataMant = $('#tableDataMant').DataTable()
                        tableDataMant.ajax.reload()
                    } else {
                        notifi(objData.msg, 'error')
                    }
                }
            }
        }
    })
}