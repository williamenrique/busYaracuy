window.addEventListener('load', function () {
	// ftnRol()
	ftnDep()
	ftnMenu()
	ftnMenu1()
	ftnSubMenu()
	fntListMenu()
}, false)


/************
 * envio de formulario de asociar menu con submenu
 */
if (document.querySelector(".formMenu")) {
	var formMenu = document.querySelector('.formMenu')
		//agregar el evento al boton del formulario
	formMenu.onsubmit = function (e) {
		e.preventDefault()
		//creamos el objeto de respuesta para diferentes navegadores
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		let ajaxUrl = base_url + 'Menu/setMenuSub'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formMenu )
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
					// Swal.fire('Asignacion correcta', objData.msg, 'success')
					notifi(objData.msg, 'success')
					formMenu.reset()
				} else {
					notifi(objData.msg,'error')
				}
			}
		}
	}
}
/*************************
 * funcion para obtener los roles
 ************************/
function ftnRol() {
	if (document.querySelector('.listRol')) {
		let ajaxUrl = base_url + "Menu/getRoles"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('.listRol').innerHTML = request.responseText
				// $("#listrol").selectpicker('render')
			}
		}
		
	}
}
/*************************
 * funcion para obtener los roles
 ************************/
function ftnDep() {
	if (document.querySelector('.listDep')) {
		let ajaxUrl = base_url + "Menu/getDep"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('.listDep').innerHTML = request.responseText
				// $("#listrol").selectpicker('render')
			}
		}
		
	}
}
/*****************
 * obtener los menu y cargarlos en el select o el radio de 
 * asociar menu con submenu
 */
function ftnMenu() {
		let ajaxUrl = base_url + "Menu/getMenu"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('.listMenu').innerHTML = request.responseText
				// $("#listMenu").selectpicker('render')
			}
		}
}
/*****************
 * obtener los menu y cargarlos en el select 2
 * se opto por duplicar la funcion para evitar falla
 */
function ftnMenu1() {
	if (document.querySelector('.listMenuAsignar')) {
		let ajaxUrl = base_url + "Menu/getMenuA"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador en formato html
				document.querySelector('.listMenuAsignar').innerHTML = request.responseText
				// $("#listMenuAsignar").selectpicker('render')
			}
		}
		
	}
}
/*****************
 * obtener los submenu y cargarlos en el checkbox
 */
function ftnSubMenu() {
	if (document.querySelector('.listSubmenu')) {
		let ajaxUrl = base_url + "Menu/getSubMenu"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('.listSubmenu').innerHTML = request.responseText
			}
		}
	}
}

/********
 * llamar al submenu dependiendo el menu
 * en el select
 */
$(document).on("change", "input[name='menuR']", function () {
	var radioOption = $('[name="menuR"]:checked').val()
	let ajaxUrl = base_url + "Menu/getSubs/" + radioOption
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('.listSubmenuAsignar').innerHTML = request.responseText
		}
	}
})
/**
 * despues de obtener los submenu enviamos el formulario
 * con el depertamanto y el submenu
 */
if (document.querySelector(".formMenuAsignar")) {
	var formMenuAsignar = document.querySelector('.formMenuAsignar')
		//agregar el evento al boton del formulario
	formMenuAsignar.onsubmit = function (e) {
		e.preventDefault()
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		formData = new FormData(formMenuAsignar)
		//creamos la ruta de envio
		let ajaxUrl = base_url + "Menu/setDepSub"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("POST", ajaxUrl, true)
		request.send(formData)
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				let objData = JSON.parse(request.responseText)
				//leemos el ststus de la respuesta
				if (objData.status) {
					// Swal.fire('Asignacion correcta', objData.msg, 'success')
					notifi(objData.msg, 'success')
					formMenuAsignar.reset()
				} else {
					notifi(objData.msg,'error')
				}
			}
		}
	}
}
/*****************
 * cargar los menu y submenu asociados
 */
fntListMenu = () =>{
	//creamos la ruta de envio
	// let ajaxUrl = base_url + "Menu/getAllMenu"
	let ajaxUrl = base_url + "Menu/listMenu"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("POST", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listAllMenu').innerHTML = request.responseText
		}
	}
}