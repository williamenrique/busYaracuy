document.addEventListener('DOMContentLoaded', function () {
    tableProducto = $('#tableProducto').DataTable({
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
            "url": ' ' + base_url + 'Producto/getProductos',
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
        dom: 'Bfrtip',
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    })
 	// ingresar un nuevo producto 
    if (document.querySelector('#formNewArticulo')) {
		var formNewArticulo = document.querySelector('#formNewArticulo')
		//agregar el evento al boton del formulario
		formNewArticulo.onsubmit = function (e) {
			e.preventDefault()
			/*************************************************
			* creamos el objeto de envio para tipo de navegador
			* hacer una validacion para diferentes navegadores y crear el formato de lectura
			* y hacemos la peticion mediante ajax
			* usando un if reducido creamos un objeto del contenido en(request)
			*****************************************************/
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Producto/setProducto'
			//creamos un objeto del formulario con los datos haciendo referencia a formData
			let formData = new FormData(formNewArticulo )
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
						formNewArticulo.reset()
						tableProducto.ajax.reload()
					} else {
						notifi(objData.msg, 'error')
					}
				}
			}
		}
	}
     // actualizar un  producto
     if (document.querySelector('#formArticuloExistnte')) {
		var formArticuloExistnte = document.querySelector('#formArticuloExistnte')
		//agregar el evento al boton del formulario
		formArticuloExistnte.onsubmit = function (e) {
			e.preventDefault()
			/*************************************************
			* creamos el objeto de envio para tipo de navegador
			* hacer una validacion para diferentes navegadores y crear el formato de lectura
			* y hacemos la peticion mediante ajax
			* usando un if reducido creamos un objeto del contenido en(request)
			*****************************************************/
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Producto/updateProducto'
			//creamos un objeto del formulario con los datos haciendo referencia a formData
			let formData = new FormData(formArticuloExistnte )
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
						formArticuloExistnte.reset()
						tableProducto.ajax.reload()
					} else {
						notifi(objData.msg, 'error')
					}
				}
			}
		}
	}
}, false)
window.addEventListener('load', function () {
	fntEnlaceArt()
	fntProveedores()
    fntUbicacion()
    fntgetArticulos()
},false)
// obtener lista de modelos
const fntEnlaceArt = () => {
	if (document.querySelector('#listEnlace')) {
		let ajaxUrl = base_url + "Producto/getSelectEnlace"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('#listEnlace').innerHTML = request.responseText
				//seleccionando el primer option
				// document.querySelector('#listEnlace').value = 1
				$("#listEnlace").selectpicker('render')
			}
		}
	}
}
// obtener lista de proveedores
const fntProveedores = () => {
	if (document.querySelector('#listProveedor')) {
		let ajaxUrl = base_url + "Producto/getSelectProvee"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('#listProveedor').innerHTML = request.responseText
				//seleccionando el primer option
				// document.querySelector('#listProveedor').value = 1
				$("#listProveedor").selectpicker('render')
			}
		}
	}
}
// obtener lista de ubicacon en los estantes
const fntUbicacion = () => {
	if (document.querySelector('#listUbicacion')) {
		let ajaxUrl = base_url + "Producto/getSelectUbic"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('#listUbicacion').innerHTML = request.responseText
				$("#listUbicacion").selectpicker('render')
			}
		}
	}
}
// obtener listado de articulo para llenar el select
const fntgetArticulos = () =>{
	let ajaxUrl = base_url + "Producto/getListProductos"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listArticuloExistente').innerHTML = request.responseText
			$("#listArticuloExistente").selectpicker('render')
		}
	}
	
}
// obtener el valor del select al clicarlo
if(document.getElementById('listArticuloExistente')){
	var select = document.getElementById('listArticuloExistente')
	select.addEventListener('change',
	  function(){
		var selectedOption = this.options[select.selectedIndex]
		let ajaxUrl = base_url + "Producto/getProducto/" + selectedOption.value
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//creamos el objeto de los datos obtenidos del controlador
				var objData = JSON.parse(request.responseText)
				//evaluamos
				if(objData.status){
					console.log(objData.data.cant_producto)
					document.querySelector("#txtCantidadActual").value = objData.data.cant_producto
					document.querySelector("#txtProveedor").value = objData.data.empresa_proveedor
					document.querySelector("#txtUbicacion").value = objData.data.ubicacion
				}else {
					Swal.fire('error', objData.msg)
				}
			}
		}
	})
}
// funcion boton eliminar producto
const fntDelProduct = (idProducto) => {
	//obtenemos el valor del atributo individual
	var idProducto = idProducto
	Swal.fire({
		title: 'Estas seguro de eliminar el producto...?',
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
			let ajaxUrl = base_url + 'Producto/delProducto/' + idProducto
			//id del atributo lr que obtuvimos enla variable
			let strData = "idProducto=" + idProducto
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
						let tableProducto = $('#tableProducto').DataTable()
						tableProducto.ajax.reload(function () {
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