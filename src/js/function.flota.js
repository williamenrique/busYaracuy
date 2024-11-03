var tableFlota
document.addEventListener('DOMContentLoaded', function () {
	/**********cargar flota en la tabla**********/
	if(document.querySelector('#tableFlota')){
		$("#tableFlota").DataTable({
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
				"url": ' ' + base_url + 'Flota/getFlota',
				"dataSrc": ''
			},
			"columns": [
				{ 'data': 'id_unidad' },
				{ 'data': 'marca_unidad' },
				{ 'data': 'modelo_unidad' },
				{ 'data': 'transmision' },
				{ 'data': 'vim_unidad' },
				{ 'data': 'fecha_creacion' },
				{ 'data': 'tipo_combustible' },
				{ 'data': 'status_unidad' }
			],
			dom: 'Bfrtip',
			"responsive": true, "lengthChange": true, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#tableFlota_wrapper .col-sm-6:eq(0)')
	}
	/**********cargar unidades en mantenimiento en la tabla**********/
	if(document.querySelector('#tableMantenimiento')){
		$('#tableMantenimiento').DataTable({
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
				"url": ' ' + base_url + 'Flota/listUnidadMantenimiento',
				"dataType":'json',
				"dataSrc": ''
			},
			"columns": [
				{ 'data': 'id_unidad' },
				{ 'data': 'fecha_entrada' },
				{ 'data': 'nomb_mecanico' },
				{ 'data': 'km_unidad' },
				{ 'data': 'tipo_mantenimiento' },
				{ 'data': 'diagnostico' },
				{ 'data': 'recomendacion' },
				{ 'data': 'fecha_salida' }
			],
			dom: 'Bfrtip',
			"responsive": true, "lengthChange": true, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#tableMantenimiento_wrapper .col-sm-6:eq(0)')
	}
})
window.addEventListener('load', function () {
    fntListOper()
	fntListMec()
},false)
/***************
 * TODO:flota
 ***************/
/****************Crear nueva unidad***********************/
if(document.querySelector('#formUnidad')){
	let formUnidad = document.querySelector('#formUnidad')
	formUnidad.onsubmit = function (e) {
		e.preventDefault()
		let intIdUnidad = document.querySelector('#idUnidad').value
		let srtIdUnidad = document.querySelector('#txtIdUnidad').value
		let srtMarcaUnidad = document.querySelector('#listMarcaUnidad').value
		let srtVimUnidad = document.querySelector('#txtVimUnidad').value
		let srtModelo = document.querySelector('#listModelo').value
		let srtFechaUnidad = document.querySelector('#txtFechaUnidad').value
		let srtCapacidad = document.querySelector('#txtCapacidad').value
		let srtTipoCombustible = document.querySelector('#txtTipoCombustible').value
		//var radioOption = $('[name="radioStatus"]:checked').val()
		//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
		//usando un if reducido creamos un objeto del contenido en (request)
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		let ajaxUrl = base_url + 'Flota/setUnidad'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formUnidad) 
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true)
		//envio de datos del formulario que se almacena enla variable
		request.send(formData)
		//despues del envio retornamos una funcion con los datos
		request.onreadystatechange = function () {
			//validamos la respuesta del servidor al enviar los datos
			if (request.readyState == 4 && request.status == 200) {
				//obtener el json y convertirlo a un objeto en javascript
				var objData = JSON.parse(request.responseText)
				//condionamos la respuesta del array del controlador
				if (objData.status) {
					formUnidad.reset()
					notifi(objData.msg, 'success')
					//refrescamos el dataTable
					let tableFlotas = $('#tableFlota').DataTable()
					//recargamos la tabla 
					tableFlotas.ajax.reload(function () {
						//cada vez que se haga una accion se recarga la tabla y los botones
					})
				} else {
					notifi(objData.msg, 'error')
				}
			}
		}
	}
}
/**********si existe el select cargamos los modelos en el select**********/
if (document.querySelector('#listModelo')) {
	let ajaxUrl = base_url + "Flota/getSelectModelo"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listModelo').innerHTML = request.responseText
			//seleccionando el primer option
			$("#listModelo").selectpicker('render')
		}
	}
}
/********** funcion cambiar el estado de la unidad***************/
function fntStatus(status,idUnidad){
	(async () => {
		/* inputOptions can be an object or Promise */
		const inputOptions = new Promise((resolve) => {
			setTimeout(() => {
			resolve({
				'1': 'Operativo',
				'0': 'Critico',
				'3': 'Inoperativo'
			})
			}, 1000)
		})
		
		const { value: color } = await Swal.fire({
			title: 'Seleccione el cambio del estado de la unidad .',
			input: 'radio',
			inputOptions: inputOptions,
			inputValidator: (value) => {
			if (!value) {
				return 'Es necesario que seleccione una opcion'
			}
			}
		})
		if (color) {
			// console.log(color)
			// Swal.fire({ html: `You selected: ${color}` })
			(async () => {
				const { value: text } = await Swal.fire({
					input: 'textarea',
					inputPlaceholder: 'Observacion por el cambio.',
					inputAttributes: {
						'aria-label': 'Observacion por el cambio.'
					},
					showCancelButton: true,
					inputValidator: (value) => {
						if (!value) {
							return 'Necesitas escribir algo!'
						}
					}
				})
				if (text) {
					//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
					let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
					let ajaxUrl = base_url + 'Flota/statusUnidad/'
					//id del atributo lr que obtuvimos enla variable
					let strData = new URLSearchParams("idUnidad="+idUnidad+"&idStatus="+color+"&srtText="+text)
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
								}else{
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
								let tableFlota = $('#tableFlota').DataTable()
								tableFlota.ajax.reload()
							}else{
								Swal.fire('Atencion!', objData.msg, 'error')
							}
						}
					}
				}
			})()
		}
	})()
}
/***************
 * TODO:unidad
 ***************/
/***************ver unidad en mantenimiento ***************************/
if(document.querySelector('#idGetUnidad')){
	//obtener los datos de la unidad en mantenimiento
	var idGetUnidad = document.querySelector('#idGetUnidad').value
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	var ajaxUrl = base_url + "Flota/getUnidad/" + idGetUnidad
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		//todo va bien 
		if (request.readyState == 4 && request.status == 200) {
			//creamos el objeto de los datos obtenidos del controlador
			document.querySelector('.unidadH').innerHTML = request.responseText
		}
	}
}
/***************
 * TODO:MANTENIMIENTO
 ***************/
// obtener lista de operadores
function fntListOper() {
	if (document.querySelector('#listOperador')) {
		let ajaxUrl = base_url + "Flota/getListOper"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('#listOperador').innerHTML = request.responseText
				//seleccionando el primer option
				// document.querySelector('#listOperador').value = 1
				$("#listOperador").selectpicker('render')
			}
		}
	}
}
// obtener lista de operadores
function fntListMec() {
	if (document.querySelector('#listMecanico')) {
		let ajaxUrl = base_url + "FLota/getListMec"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('#listMecanico').innerHTML = request.responseText
				//seleccionando el primer option
				// document.querySelector('#listMecanico').value = 1
				$("#listMecanico").selectpicker('render')
			}
		}
	}
}
/**********si existe el select cargamos las unidades en los select**********/
if (document.querySelector('#listUnidad')) {
	let ajaxUrl = base_url + "Flota/getSelectUnidad"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listUnidad').innerHTML = request.responseText
			//seleccionando el primer option
			$("#listUnidad").selectpicker('render')
		}
	}
}
/***************si existe el formulario ingresamos unidad en mantenimiento ***************************/
if(document.querySelector('#formIngMantUnidad')){
	let formIngMantUnidad = document.querySelector('#formIngMantUnidad')
	formIngMantUnidad.onsubmit = function (e) {
		e.preventDefault()
		//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
		//usando un if reducido creamos un objeto del contenido en (request)
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		let ajaxUrl = base_url + 'Flota/setIMantenimiento'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formIngMantUnidad) 
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true)
		//envio de datos del formulario que se almacena enla variable
		request.send(formData)
		//despues del envio retornamos una funcion con los datos
		request.onreadystatechange = function () {
			//validamos la respuesta del servidor al enviar los datos
			if (request.readyState == 4 && request.status == 200) {
				//obtener el json y convertirlo a un objeto en javascript
				let objData = JSON.parse(request.responseText)
				//condionamos la respuesta del array del controlador
				if (objData.status) {
					formIngMantUnidad.reset()
					notifi(objData.msg, 'success')
					//refrescamos el dataTable
					let tableMantenimiento = $('#tableMantenimiento').DataTable()
					location.reload();
					//buscar como rcargar el select
					tableMantenimiento.ajax.reload(function () {
						//cada vez que se haga una accion se recarga la tabla y los botones
						$("#listUnidad").selectpicker('render')
					})
				} else {
					notifi(objData.msg, 'error')
				}
			}
		}
	}
}
/***************sacar unidad de mantenimiento ***************************/
function fntOutMant(idFlota){
	//usando un if reducido creamos un objeto del contenido en (request)
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + 'Flota/outMantenimiento/' + idFlota 
	//creamos un objeto del formulario con los datos haciendo referencia a formData
	let formData = new FormData(mantOut) 
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true)
	//envio de datos del formulario que se almacena enla variable
	request.send(formData)
	//despues del envio retornamos una funcion con los datos
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			//obtener el json y convertirlo a un objeto en javascript
			var objData = JSON.parse(request.responseText)
			//condionamos la respuesta del array del controlador
			if (objData.status) {
				notifi(objData.msg, 'success')
				mantOut = document.querySelector("#mantOut")
				mantOut.reset()
				// recargar la pagina
			} else {
				notifi(objData.msg, 'error')
			}
		}
	}
}
/***************
 * TODO: editar unidad
 ***************/
if(document.getElementById('idGetUnidadEdit')){
	//obtener los datos de la unidad en mantenimiento
	let idGetUnidadEdit = document.querySelector('#idGetUnidadEdit').value
	//creamos el objeto para os navegadores
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + "Flota/getUnidadEdit/" + idGetUnidadEdit
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		//todo va bien 
		if (request.readyState == 4 && request.status == 200) {
			//creamos el objeto de los datos obtenidos del controlador
			document.querySelector('#boxUnidadEdit').innerHTML = request.responseText
		}
	}
}
// actualizar una unidad
fntUpdateUnd = () =>{
	let formUnidadEdit = document.getElementById('formUnidadEdit')
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + "Flota/updateUnidad"
	//creamos un objeto del formulario con los datos haciendo referencia a formData
	let formData = new FormData(formUnidadEdit)
	request.open("POST", ajaxUrl, true)
	request.send(formData)
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			//obtener el json y convertirlo a un objeto en javascript
			let objData = JSON.parse(request.responseText)
			//condionamos la respuesta del array del controlador
			if(objData.status){
				notifi(objData.msg,'info')
			}else{
				notifi(objData.msg,'error')
			}
		}
	}
}