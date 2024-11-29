document.addEventListener('DOMContentLoaded', function () {
    // tabla hstoria de articulo
    if(document.getElementById('tableHproductoG')){
        tableHproductoG = $('#tableHproductoG').DataTable({
            pageLength: 50,
            "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible",
            "sInfo": "Total de _TOTAL_ Registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
            },
            "responsive": {
                "name": "medium",
                "width": "1188"
            },
            "ajax": {
                "url": ' ' + base_url + 'Producto/getHproductos',
                "dataSrc": ''
            },
            "columns": [
                { 'data': 'ID' },
                { 'data': 'PRODUCTO' },
                { 'data': 'DISPONIBLE' },
                { 'data': 'ENTREGADO' },
                { 'data': 'PRESENTACION' },
                { 'data': 'DESDE' },
                { 'data': 'HASTA' }
            ],
            dom: 'Bfrtip',
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        })
    }
    if(document.querySelector('#idGetArticulo')){
        let idGetArticulo = document.querySelector('#idGetArticulo').value
        tableHproductoU = $('#tableHproductoU').DataTable({
            pageLength: 50,
            "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible",
            "sInfo": "Total de _TOTAL_ Registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
            },
            "responsive": {
                "name": "medium",
                "width": "1188"
            },
            "ajax": {
                "url": ' ' + base_url + "Producto/getProductoH/" + idGetArticulo,
                "dataSrc": ''
            },
            "columns": [
                { 'data': 'UNIDAD' },
                { 'data': 'ENTREGADO' },
                { 'data': 'FECHA' }
            ],
            dom: 'Bfrtip',
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        })
    }

}, false)

/***************
 * TODO: historia articulo
 ***************/
/***************ver unidad en mantenimiento ***************************/
if(document.querySelector('#idGetArticulo')){
	//obtener los datos de la unidad en mantenimiento
	var idGetArticulo = document.querySelector('#idGetArticulo').value
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	var ajaxUrl = base_url + "Producto/getDataArtH/" + idGetArticulo
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		//todo va bien hasta <span id="strHasta"></span></span></strong></h3>
		if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText)
			//creamos el objeto de los datos obtenidos del controlador
			document.getElementById('strArticulo').innerHTML = objData.PRODUCTO
			document.getElementById('strDisponible').innerHTML = objData.DISPONIBLE + ' ' + objData.PRESENTACION
			document.getElementById('strEntregado').innerHTML = objData.ENTREGADO + ' ' + objData.PRESENTACION
			document.getElementById('strDesde').innerHTML = objData.DESDE
			document.getElementById('strHasta').innerHTML = objData.HASTA
		}
	}
}