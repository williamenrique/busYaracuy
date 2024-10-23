document.addEventListener('DOMContentLoaded', function () {
	tableUser = $('#tableUser').DataTable({
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
			"url": ' ' + base_url + 'Usuarios/getUsers',
			"dataSrc": ''
		},
		"columns": [
			{ 'data': 'user_id' },
			{ 'data': 'user_nick' },
			{ 'data': 'user_nombres' },
			{ 'data': 'user_apellidos' },
			{ 'data': 'user_email' },
			{ 'data': 'user_tlf' },
			{ 'data': 'rol_name' },
			{ 'data': 'user_status' },
			{ 'data': 'opciones' }
		],
		"resonsieve": "true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order": [[0, "asc"]]
	})
/******* crear usuario ********/
if (document.querySelector('#formUser')) {
		var formUser = document.querySelector('#formUser')
		//agregar el evento al boton del formulario
		formUser.onsubmit = function (e) {
			e.preventDefault()
			/*************************************************
			* creamos el objeto de envio para tipo de navegador
			* hacer una validacion para diferentes navegadores y crear el formato de lectura
			* y hacemos la peticion mediante ajax
			* usando un if reducido creamos un objeto del contenido en(request)
			*****************************************************/
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Usuarios/setUser'
			//creamos un objeto del formulario con los datos haciendo referencia a formData
			let formData = new FormData(formUser )
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
						formUser.reset()
						tableUser.ajax.reload()
					} else {
						notifi(objData.msg, 'error')
					}
				}
			}
		}
	}
}, false)
window.addEventListener('load', function () {
	fntRolesUsuarios()
},false)
/**********si existe el select cargamos los modelos en el select**********/
if (document.querySelector('#listDep')) {
	let ajaxUrl = base_url + "Usuarios/getSelectDep"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listDep').innerHTML = request.responseText
			//seleccionando el primer option
			$("#listDep").selectpicker('render')
		}
	}
}
/******* cargar roles usuario ********/
function fntRolesUsuarios() {
	if (document.querySelector('#listRolId')) {
		let ajaxUrl = base_url + "Usuarios/getSelectRoles";
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true);
		request.send();
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('#listRolId').innerHTML = request.responseText;
				//seleccionando el primer option
				// document.querySelector('#listRolId').value = 1;
				$("#listRolId").selectpicker('render');
			}
		}

	}
}
/******* deshabilitar usuario ********/
function fntDelUser(idUser) {
	//obtenemos el valor del atributo individual
	var idUser = idUser
	Swal.fire({
		title: 'Estas seguro de eliminar el usuario?',
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
			let ajaxUrl = base_url + 'Usuarios/delUser/' + idUser
			//id del atributo lr que obtuvimos enla variable
			let strData = "idUser=" + idUser
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
						//Swal.fire('Proceso Exitoso!', objData.msg, 'success')
						let tableRoles = $('#tableRol').DataTable()
						tableUser.ajax.reload(function () {
							//cada vez que se haga una accion se recarga la tabla y los botones
							fntRolesUsuarios()
						})
					} else {
						Swal.fire('Atencion!', objData.msg, 'error')
					}
				}
			}
		}
	})
}
/******* cambiar status ********/
function fntStatus(status,idUser) {
	//obtenemos el valor del atributo individual
	var status = status
	Swal.fire({
		title: 'Estas seguro de cambiar el estado del usuario?',
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
			let ajaxUrl = base_url + 'Usuarios/statusUser/'
			//id del atributo lr que obtuvimos enla variable
			// let strData = [{"status" :status,"idUser": idUser}]
			let strData = new URLSearchParams("idUser="+idUser+"&status="+status)
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
							// if (boxUserHigh) {
							// 	tableUserHigh.ajax.reload()
							// }
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
						//Swal.fire('Proceso Exitoso!', objData.msg, 'success')
						let tableRoles = $('#tableRol').DataTable()
						tableUser.ajax.reload()
					} else {
						Swal.fire('Atencion!', objData.msg, 'error')
					}
				}
			}
		}
	})
}

/*****************
 * actualizar perfil
 */
function compararPass() {
	if (strPass != strPassC) {
		Swal.fire('Password  no coinciden!', 'Oops...', 'info');
		return false;
	}
	var strPass = document.querySelector('#textPass').value;
	var strPassC = document.querySelector('#textPassConfirm').value;
}
//actualizar datos
if (document.querySelector('#formDatos')) {
	var	formDatos = document.querySelector('#formDatos');
	formDatos.onsubmit = function (e) {
		e.preventDefault();
		/*************************************************
		* creamos el objeto de envio para tipo de navegador
		* hacer una validacion para diferentes navegadores y crear el formato de lectura
		* y hacemos la peticion mediante ajax
		* usando un if reducido creamos un objeto del contenido en(request)
		*****************************************************/
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url + 'Usuarios/UpdatePerfil';
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formDatos );
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true);
		//envio de datos del formulario que se almacena enla variable
		request.send(formData);
		//obtenemos los resultados y evaluamos
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//obtenemos los datos y convertimos en JSON
				let objData = JSON.parse(request.responseText);
				//leemos el ststus de la respuesta
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
					location.reload();
					//Swal.fire('Usuario', objData.msg, 'success');
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: objData.msg
					})
				}
			}
		}
	}
}
//cambiar password
if (document.querySelector('#formPass')) {
	var	formPass = document.querySelector('#formPass');
	formPass.onsubmit = function (e) {
		e.preventDefault();
		/*************************************************
		* creamos el objeto de envio para tipo de navegador
		* hacer una validacion para diferentes navegadores y crear el formato de lectura
		* y hacemos la peticion mediante ajax
		* usando un if reducido creamos un objeto del contenido en(request)
		*****************************************************/
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url + 'Usuarios/UpdatePerfil';
		//creamos un objeto del formulario con los Pass haciendo referencia a formData
		let formData = new FormData(formPass );
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true);
		//envio de datos del formulario que se almacena enla variable
		request.send(formData);
		//obtenemos los resultados y evaluamos
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//obtenemos los datos y convertimos en JSON
				let objData = JSON.parse(request.responseText);
				//leemos el ststus de la respuesta
				if (objData.status) {
					// $("#modalUser").modal("hide");
					Swal.fire('Usuario', objData.msg, 'success');
					formPass.reset()
					// tableUser.ajax.reload()
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: objData.msg
					})
				}
			}
		}
	}
}
/*************imagen del usuario*******************/
let msj = document.querySelector('.msj')
let file = document.querySelector('#file')
let btn = document.querySelector('.btnSubir')
let formData = new FormData()
let formImg = document.querySelector('.formImg')
if (document.querySelector('.formImg')) {
	formImg.onsubmit = function (e) {
		e.preventDefault()
		if (file.files[0] == null) {
			notifi('Seleccione una imagen de 300x300 ','info')
		} else {
			// console.log(file.files[0].size)
			// console.log(file.files[0].type)
			/*************************************************
			* creamos el objeto de envio para tipo de navegador
			* hacer una validacion para diferentes navegadores y crear el formato de lectura
			* y hacemos la peticion mediante ajax
			* usando un if reducido creamos un objeto del contenido en(request)
			*****************************************************/
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Usuarios/subirImagen'
			//creamos un objeto del formulario con los Pass haciendo referencia a formData
			let formData = new FormData(formImg )
			//prepara los datos por ajax preparando el dom
			request.open('POST', ajaxUrl, true)
			//envio de datos del formulario que se almacena enla variable
			request.send(formData)
			//obtenemos los resultados y evaluamos
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					//obtenemos los datos y convertimos en JSON
					let objData = JSON.parse(request.responseText)
					//leemos el ststus de la respuesta
					if (objData.status) {
						notifi(objData.msg, 'info')
						formImg.reset()
						file.value = ""
						createClearFormData()
						location.reload();
					} else {
						notifi(objData.msg, 'error')
					}
				}
			}
		} 
	}
}

if(document.querySelector('.search')){
	let search = document.querySelector('.search')
	search.addEventListener('click', () => {
		document.querySelector('#file').click()
		file.value = ""
		createClearFormData()
	})
}
file.addEventListener('change', (e) => { 
	// msj.innerText = file.files[0].name
	document.getElementById('preview-images').setAttribute('opacity', `0`)
	let thumbnail = document.createElement('div') // generar un elemento
	thumbnail.classList.add('thumbnail',0) // asignarle una clase y el id
	thumbnail.dataset.id = 0  //crear un atributo con dat.set y le asignamos el id
	thumbnail.setAttribute('style', `background-image : url(${URL.createObjectURL(file.files[0])})`)
	document.getElementById('preview-images').appendChild(thumbnail)
	createClose(0)
})
const createClearFormData = () => {
	// recorrer el formaData
	for (let key of formData.keys()) {
		//llamamos el formadata y le pasamos el delete con el key
		formData.delete(key)
		console.log(key)
	}
	// quitar todos los thumbnail
	document.querySelectorAll('.thumbnail').forEach((thumbnail) => {
		thumbnail.remove()
	})
}
// funcion para clrear el boton de cerrar la imagen
const createClose = (thumbnail_id) => {
	let closeButton = document.createElement('div')
	closeButton.classList.add('close-button')
	closeButton.innerText = 'x'
	// despues de crear la funcion para cerrar
	document.getElementsByClassName(thumbnail_id)[0].appendChild(closeButton)
}
// agregamos al body y action de escucha al momento de cancelar la imagen
document.body.addEventListener('click', function (e) {
	if ( e.target.classList.contains('close-button') ) {
		e.target.parentNode.remove()
		formData.delete(e.target.parentNode.dataset.id)
		// file.value = ""
		// msj.innerText = ""
		document.getElementById('preview-images').setAttribute('all', `unset`)
	}
})