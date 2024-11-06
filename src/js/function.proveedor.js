document.addEventListener('DOMContentLoaded', function () {
    tableProveedor = $('#tableProveedor').DataTable({
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
        "url": ' ' + base_url + 'Proveedor/getProveedores',
        "dataSrc": ''
    },
    "columns": [
        { 'data': 'id_proveedor' },
        { 'data': 'rif_proveedor' },
        { 'data': 'empresa_proveedor' },
        { 'data': 'responsable_proveedor' },
        { 'data': 'tlf_proveedor' },
        { 'data': 'email_proveedor' },
        { 'data': 'status_proveedor' },
        { 'data': 'opciones' }
    ],
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "asc"]]
    })
    /******************************
	 * ingresar un nuevo proveedor 
	 *****************************/
    if (document.querySelector('#formProveedor')) {
		var formProveedor = document.querySelector('#formProveedor')
		//agregar el evento al boton del formulario
		formProveedor.onsubmit = function (e) {
			e.preventDefault()
			/*************************************************
			* creamos el objeto de envio para tipo de navegador
			* hacer una validacion para diferentes navegadores y crear el formato de lectura
			* y hacemos la peticion mediante ajax
			* usando un if reducido creamos un objeto del contenido en(request)
			*****************************************************/
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Proveedor/setProveedor'
			//creamos un objeto del formulario con los datos haciendo referencia a formData
			let formData = new FormData(formProveedor )
			//prepara los datos por ajax preparando el dom
			request.open('POST', ajaxUrl, true)
			//envio de datos del formulario que se almacena enla variable
			request.send(formData)
			//obtenemos los resultados
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					//obtenemos los datos y convertimos en JSON
					let objData = JSON.parse(request.responseText)
					//leemos el ststus de la respuesta
					if (objData.status) {
						notifi(objData.msg, 'success')
						formProveedor.reset()
						tableProveedor.ajax.reload()
					} else {
						notifi(objData.msg, 'error')
					}
				}
			}
		}
	}
}, false)

/*********************************
 * funcion boton eliminar usuario
 ********************************/
const fntDelProveedor = (idProveedor) => {
	//obtenemos el valor del atributo individual
	var idProveedor = idProveedor
	Swal.fire({
		title: 'Estas seguro de eliminar el Proveedor?',
		text: "No podra ser revertido el proceso!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: 'btn btn-success',
		cancelButtonColor: 'btn btn-danger',
		confirmButtonText: 'Si, eliminar!'
	}).then((result) => {
		if (result.isConfirmed) {
			//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Proveedor/delProveedor/' + idProveedor
			//id del atributo lr que obtuvimos enla variable
			let strData = "idProveedor=" + idProveedor
			request.open("POST", ajaxUrl, true)
			//forma en como se enviara
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			//enviamos
			request.send(strData)
			request.onreadystatechange = function () {
				//comprobamos la peticion
				if (request.readyState == 4 && request.status == 200) {
					//convertir en objeto JSON
					let objData = JSON.parse(request.responseText)
					if (objData.status) {
						$(function () {
							var Toast = Swal.mixin({
								toast: true,
								position: 'top-end',
								showConfirmButton: false,
								timer: 3000
							})
							Toast.fire({
								icon: 'success',
								title: objData.msg
							})
						})
						let tableProveedor = $('#tableProveedor').DataTable()
						tableProveedor.ajax.reload(function () {
							//cada vez que se haga una accion se recarga la tabla y los botones
						})
					} else {
						Swal.fire('Atencion!', objData.msg, 'error')
					}
				}
			}
		}
	})
}
/******************
 * cambiar status
 *****************/
const fntStatus = (status,idProveedor) => {
	//obtenemos el valor del atributo individual
	var status = status
	Swal.fire({
		title: 'Estas seguro de cambiar el estado del Proveedor?',
		// text: "No podra ser revertido el proceso!",
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: 'btn btn-success',
		cancelButtonColor: 'btn btn-danger',
		confirmButtonText: 'Si, cambiar!'
	}).then((result) => {
		if (result.isConfirmed) {
			//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Proveedor/statusProveedor/'
			//id del atributo lr que obtuvimos enla variable
			let strData = new URLSearchParams("idProveedor="+idProveedor+"&status="+status)
			request.open("POST", ajaxUrl, true)
			//forma en como se enviara
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			//enviamos
			request.send(strData)
			// request.send()
			request.onreadystatechange = function () {
				//comprobamos la peticion
				if (request.readyState == 4 && request.status == 200) {
					//convertir en objeto JSON
					let objData = JSON.parse(request.responseText)
					if (objData.status) {
						if (objData.estado == 1) {
							$(function () {
								var Toast = Swal.mixin({
									toast: true,
									position: 'top-end',
									showConfirmButton: false,
									timer: 3000
								})
								Toast.fire({
									icon: 'success',
									title: objData.msg
								})
							})
						} else {
							$(function () {
								var Toast = Swal.mixin({
									toast: true,
									position: 'top-end',
									showConfirmButton: false,
									timer: 3000
								})
								Toast.fire({
									icon: 'success',
									title: objData.msg
								})
							})
						}
						let tableProveedor = $('#tableProveedor').DataTable()
						tableProveedor.ajax.reload()
					} else {
						Swal.fire('Atencion!', objData.msg, 'error')
					}
				}
			}
		}
	})
}