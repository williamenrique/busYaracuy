document.addEventListener('DOMContentLoaded', function () {
    /**********cargar unidades en mantenimiento en la tabla**********/
    if(document.querySelector('#tableArticulo')){
        $('#tableArticulo').DataTable({
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
                "url": ' ' + base_url + 'Datamant/getProductos',
                "dataType":'json',
                "dataSrc": ''
            },
            "columns": [
                { 'data': 'id_producto' },
                { 'data': 'producto' },
                { 'data': 'enlace_producto' },
                { 'data': 'empresa_proveedor' },
                { 'data': 'ubicacion' },
                { 'data': 'cant_producto' },
                { 'data': 'opciones' }
            ],
            paging: false,
            scrollCollapse: true,
            scrollY: '50vh',
            dom: 'Bfrtip',
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tableArticulo_wrapper .col-sm-6:eq(0)')
    }
   
})
