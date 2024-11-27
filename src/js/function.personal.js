var tablePersonal
document.addEventListener('DOMContentLoaded', function () {
    /**********cargarcargar  en la tabla**********/
	if(document.querySelector('#tablePersonal')){
		$("#tablePersonal").DataTable({
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
				"url": ' ' + base_url + 'Personal/getPersonal',
				"dataSrc": ''
			},
			"columns": [
				{ 'data': 'personal_cedula' },
				{ 'data': 'personal_nombre' },
				{ 'data': 'cargo' },
				{ 'data': 'personal_tlf' },
				{ 'data': 'personal_status' },
				{ 'data': 'accion' }
			],
			dom: 'Bfrtip',
			"responsive": true, "lengthChange": true, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#tablePersonal_wrapper .col-sm-6:eq(0)')
	}
})
/**********insertar personal**********/
if (document.querySelector('#formPersonal')) {
	var formPersonal = document.querySelector('#formPersonal')
		//agregar el evento al boton del formulario
	formPersonal.onsubmit = function (e) {
		e.preventDefault()
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url + 'Personal/setPersonal'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formPersonal )
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true)
		//envio de datos del formulario que se almacena enla variable
		request.send(formData)
		//obtenemos los resultados
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//obtenemos los datos y convertimos en JSON
				let objData = JSON.parse(request.responseText);
				//leemos el ststus de la respuesta
				if (objData.status) {
					notifi(objData.msg, 'success')
					formPersonal.reset()
					tablePersonal.ajax.reload()
				} else {
					notifi(objData.msg, 'error')
				}
			}
		}
	}
}
/**********si existe el select cargamos los puestos de trabajo en el select**********/
if (document.querySelector('#listCargo')) {
	let ajaxUrl = base_url + "Personal/getSelectCargo"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listCargo').innerHTML = request.responseText
			//seleccionando el primer option
			$("#listCargo").selectpicker('render')
		}
	}
}
/********** funcion cambiar el estado del personal***************/
function fntStatus(status,idPersonal){
	(async () => {
		/* inputOptions can be an object or Promise */
		const inputOptions = new Promise((resolve) => {
			setTimeout(() => {
			resolve({
				'1': 'Activo',
				'0': 'Inactivo',
				'2': 'Vacaciones',
				'3': 'Reposo'
			})
			}, 1000)
		})
		
		const { value: color } = await Swal.fire({
			title: 'Seleccione el cambio del estado dl personal .',
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
					let ajaxUrl = base_url + 'Personal/statusPersonal/'
					//id del atributo lr que obtuvimos enla variable
					let strData = new URLSearchParams("idPersonal="+idPersonal+"&idStatus="+color+"&srtText="+text)
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
								let tablePersonal = $('#tablePersonal').DataTable()
								tablePersonal.ajax.reload()
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
// TODO: editar personal
/********** editar datos de personal ***************/
const fntEditModal = (idPersonal) => {
	let ajaxUrl = base_url + "Personal/getPersonalEdit/"
	let strData = new URLSearchParams("idPersonal="+idPersonal)
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("POST", ajaxUrl, true)
	request.send(strData)
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			let objData = JSON.parse(request.responseText)
			document.querySelector("#idPersonal").value = objData.id_personal
			document.querySelector("#txtNombreEdit").value = objData.personal_nombre
			document.querySelector("#txtCedulaEdit").value = objData.personal_cedula		
			document.querySelector("#txtTelefonoEdit").value = objData.personal_tlf
			let a = $("select#listTagPersonalEdit").val()
			const tag = [
				{ id: 0, tag: "SELECCIONE" },
				{ id: 1, tag: "INFORMATICA" },
				{ id: 2, tag: "ALMACEN"},
			]
			let index = tag.find(el=> el.id == objData.personal_tag)
			const $select = document.querySelector("#listTagPersonalEdit")
			const opcion = Object.assign(document.createElement("option"), {
				value: objData.personal_tag,
				text: index.tag,
			})
			$select.appendChild(opcion)
			for (const tags of tag) {
				const opcion = Object.assign(document.createElement("option"), {
					value: tags.id,
					text: tags.tag,
				})
				$select.appendChild(opcion)
			}
		}
	}
	fntCargo(idPersonal)
}
// borrar contenido del select de enlace de personal
if(document.getElementById("btnClose")){
	document.getElementById("btnClose").addEventListener('click',function(){
		const $select = document.querySelector("#listTagPersonalEdit")
		for (let i = $select.options.length; i >= 0; i--) {
			$select.remove(i);
		}
	})
}
/**********actualizar datos de personal **********/
if (document.querySelector('#formEditPersonal')) {
	var formEditPersonal = document.querySelector('#formEditPersonal')
		//agregar el evento al boton del formulario
	formEditPersonal.onsubmit = function (e) {
		e.preventDefault()
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url + 'Personal/updatePersona'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formEditPersonal )
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true)
		//envio de datos del formulario que se almacena enla variable
		request.send(formData)
		//obtenemos los resultados
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//obtenemos los datos y convertimos en JSON
				let objData = JSON.parse(request.responseText);
				//leemos el ststus de la respuesta
				if (objData.status) {
					notifi(objData.msg, 'success')
					let tablePersonal = $('#tablePersonal').DataTable()
					tablePersonal.ajax.reload()
					// let modal = new bootstrap.Modal(document.getElementById("modalEditPersonal"));
    				// modal.hide()
					$('#modalEditPersonal').modal('hide')
				} else {
					notifi(objData.msg, 'error')
				}
			}
		}
	}
}
/********** traer el cargo de un perosnal ***************/
const fntCargo = (idPersonal) => {
	let ajaxUrl = base_url + "Personal/getSelectCargoP/" + idPersonal
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listCargoEdit').innerHTML = request.responseText
		}
	}
}