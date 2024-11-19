window.addEventListener('load', function () {
	fntListUnidad()
    fntListOper()
	fntListMec()
	fntListDesp()
	fntListArticulos()
},false)
// obtener lista de unidades
function fntListUnidad() {
	if (document.querySelector('#listUnidad')) {
		let ajaxUrl = base_url + "Orden/getListFlota"
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
				// document.querySelector('#listUnidad').value = 1
				$("#listUnidad").selectpicker('render')
			}
		}
	}
}
// obtener el valor del select al clicarlo de las unidades
if(document.getElementById('listUnidad')){
	var listUnidad = document.getElementById('listUnidad')
	listUnidad.addEventListener('change',
	  function(){
		var selectedOption = this.options[listUnidad.selectedIndex]
		let ajaxUrl = base_url + "Orden/getUnidad/" + selectedOption.value
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
					// console.log(objData.data.id_flota)
					document.querySelector("#id_unidad").innerHTML = objData.data.id_unidad
					document.querySelector("#vim_unidad").innerHTML = objData.data.vim_unidad
					document.querySelector("#marca_unidad").innerHTML = objData.data.marca_unidad
					document.querySelector("#modelo_unidad").innerHTML = objData.data.modelo_unidad
					document.querySelector("#tipo_combustible").innerHTML = objData.data.tipo_combustible
				}else {
					Swal.fire('error', objData.msg)
				}
			}
		}
	})
}
// obtener fecha
// if(document.getElementById('fechaDespacho')){
// 	var f = new Date();
// 	let fecha = (f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear())
// 	document.getElementById('fechaDespacho').innerHTML = fecha
// }
if(document.getElementById('fechaDespacho')){
	let txtdate = document.getElementById('txtdate')
	txtdate.addEventListener('change',
	function(){
		let date = document.getElementById('txtdate').value
		let strDate = document.getElementById('strDate').value = date
		console.log(date)
		document.getElementById('fechaDespacho').innerHTML = date
	})
}

// obtener lista de operadores
function fntListOper() {
	if (document.querySelector('#listOperador')) {
		let ajaxUrl = base_url + "Orden/getListOper"
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
// obtener el valor del select al clicarlo de los operadores
if(document.getElementById('listOperador')){
	var listOperador = document.getElementById('listOperador')
	listOperador.addEventListener('change',
	  function(){
		var selectedOption = this.options[listOperador.selectedIndex]
		let ajaxUrl = base_url + "Orden/getPersonal/" + selectedOption.value
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
					document.querySelector("#operador").innerHTML = objData.data.personal_nombre
					document.querySelector("#txtOper").value = objData.data.personal_nombre
				}else {
					Swal.fire('error', objData.msg)
				}
			}
		}
	})
}
// obtener lista de operadores
function fntListMec() {
	if (document.querySelector('#listMecanico')) {
		let ajaxUrl = base_url + "Orden/getListMec"
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
// obtener el valor del select al clicarlo de los mecanicos
if(document.getElementById('listMecanico')){
	var listMecanico = document.getElementById('listMecanico')
	listMecanico.addEventListener('change',
	  function(){
		var selectedOption = this.options[listMecanico.selectedIndex]
		let ajaxUrl = base_url + "Orden/getPersonal/" + selectedOption.value
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
					document.querySelector("#mecanico").innerHTML = objData.data.personal_nombre
					document.querySelector("#txtMec").value = objData.data.personal_nombre
				}else {
					Swal.fire('error', objData.msg)
				}
			}
		}
	})
}
// obtener lista de despachadores de almacen
function fntListDesp() {
	if (document.querySelector('#listDespachador')) {
		let ajaxUrl = base_url + "Orden/getListDesp"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('#listDespachador').innerHTML = request.responseText
				//seleccionando el primer option
				// document.querySelector('#listDespachador').value = 1
				$("#listDespachador").selectpicker('render')
			}
		}
	}
}
// obtener el valor del select al clicarlo de los despachadores de almacen
if(document.getElementById('listDespachador')){
	var listDespachador = document.getElementById('listDespachador')
	listDespachador.addEventListener('change',
	  function(){
		var selectedOption = this.options[listDespachador.selectedIndex]
		let ajaxUrl = base_url + "Orden/getPersonal/" + selectedOption.value
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
					document.querySelector("#despachador").innerHTML = objData.data.personal_nombre
					document.querySelector("#txtDesp").value = objData.data.personal_nombre
				}else {
					Swal.fire('error', objData.msg)
				}
			}
		}
	})
}
// obtener lista de articulos del almacen
function fntListArticulos() {
	if (document.querySelector('#listArticulo')) {
		let ajaxUrl = base_url + "Orden/getListArt"
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		//abrimos la conexion y enviamos los parametros para la peticion
		request.open("GET", ajaxUrl, true)
		request.send()
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				//option obtenidos del controlador
				document.querySelector('#listArticulo').innerHTML = request.responseText
				//seleccionando el primer option
				$("#listArticulo").selectpicker('render')
			}
		}
	}
}
// obtener el valor del select al clicarlo de los articuos
if(document.getElementById('listArticulo')){
	var listArticulo = document.getElementById('listArticulo')
	listArticulo.addEventListener('change',
	  function(){
		var selectedOption = this.options[listArticulo.selectedIndex]
		let ajaxUrl = base_url + "Orden/getArt/" + selectedOption.value
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
					cantProducto(objData.data.cant_producto) 
					document.getElementById("cantDispo").value = objData.data.cant_producto
					document.getElementById("txtCant").value = ""
				}else {
					Swal.fire('error', objData.msg)
				}
			}
		}
	})
}
let cantProducto = () =>{
	let cantDispo = document.getElementById("cantDispo").value
	// let cantDispo = cantDispo
	let srtCant = parseInt(document.getElementById("txtCant").value)
	// console.log('cantidad diponible = '+cantDispo+' contidad tieada es: '+srtCant)
	cantDispo < srtCant ? document.getElementById("txtCant").value = "" : srtCant
}
// agregar filas a la tabla del despacho
if(document.getElementById('btnAgrega')){
	let btnAgrega = document.getElementById('btnAgrega')
	var listArticulo = document.getElementById('listArticulo')
	// var selectedOption = this.options[listDespachador.selectedIndex]
	btnAgrega.addEventListener('click',
		function(){
			var select = document.getElementById('listArticulo')
			var option = select.options[select.selectedIndex]
			let cant = document.getElementById('txtCant').value
			if(select.options[select.selectedIndex].value == "0" || cant == ""){
				notifi("Debe llenar los campos", 'info')
			}else{
				var item = `
					<tr>
						<td><input type="hidden" name="cod[]"  value='`+option.value+`'/><span>COD 0`+option.value+`</span></td>
						<td><input type="hidden" name="articulo[]"  value='`+option.text+`'/><span>`+option.text+`</span></td>
						<td><input type="hidden" name="cantidad[]"  value='`+cant+`'/><span>`+cant+`</span></td>
						<td>
							<button type="button" class="btn btn-danger btn-sm ml-3 eliminarRow">
								<i class="fas fa-trash-alt"></i>
							</button>
						</td>
					  </tr>
					`
					$("#lista").append(item)
					document.getElementById('txtCant').value = ""
			}	
	})
}
//TODO: enviar orden de de despacho
if(document.getElementById('formDespacho')){
	let formDespacho = document.querySelector('#formDespacho')
	let tableDesp = document.getElementById('tableDesp')
	//agregar el evento al boton del formulario
	formDespacho.onsubmit = function (e) {
		e.preventDefault()
		/*************************************************
		* creamos el objeto de envio para tipo de navegador
		* hacer una validacion para diferentes navegadores y crear el formato de lectura
		* y hacemos la peticion mediante ajax
		* usando un if reducido creamos un objeto del contenido en(request)
		*****************************************************/
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		let ajaxUrl = base_url + 'Orden/setOrdenD'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formDespacho )
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
					formDespacho.reset()
					const btnGenerar = document.getElementById('btnGenerar');
					btnGenerar.disabled = true
					location.reload()
				} else {
					notifi(objData.msg, 'error')
				}
			}
		}
	}
}
// eliminar filas no deseadas para la orden
if(document.getElementById('tableDesp')){
	const  tableDesp = document.getElementById('tableDesp')
	tableDesp.addEventListener('click',verificarClick)
}
// verificar si se preciono eliminar fila
function verificarClick(e){
	if(e.target.matches('.eliminarRow')){
		const tIndex = e.target.parentNode.parentNode.rowIndex
		tableDesp.deleteRow(tIndex)
	}
}

// TODO:lista de ordenes en tarjetas
if(document.getElementById('boxInvoce')){
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	var ajaxUrl = base_url + "Orden/getOrdenes"
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		//todo va bien 
		if (request.readyState == 4 && request.status == 200) {
			//creamos el objeto de los datos obtenidos del controlador
			document.getElementById('boxInvoce').innerHTML = request.responseText
		}
	}
}
// buscador de ordenes
if(document.getElementById("formBuscarDesp")){
	let formBuscarDesp = document.querySelector('#formBuscarDesp')
	//agregar el evento al boton del formulario
	formBuscarDesp.onsubmit = function (e) {
		e.preventDefault()
		/*************************************************
		* creamos el objeto de envio para tipo de navegador
		* hacer una validacion para diferentes navegadores y crear el formato de lectura
		* y hacemos la peticion mediante ajax
		* usando un if reducido creamos un objeto del contenido en(request)
		*****************************************************/
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		let ajaxUrl = base_url + 'Orden/getBuscarOrden'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formBuscarDesp )
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true)
		//envio de datos del formulario que se almacena enla variable
		request.send(formData)
		//obtenemos los resultados
		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
				document.getElementById('boxInvoce').innerHTML = request.responseText
			}
		}
	}
}
// funcion para generar el pdf del despacho para imprimir
fntImpDespacho = (idDespacho) =>{
	let ajaxUrl = base_url + "Orden/reporteDesp/" + idDespacho
    //creamos el objeto para os navegadores
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
    //abrimos la conexion y enviamos los parametros para la peticion
    request.open("POST", ajaxUrl, true)
    request.send()
    request.onreadystatechange = function () {
        //todo va bien 
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText)
			//condionamos la respuesta del array del controlador
			if (objData.status) { 
				notifi(objData.msg,'info')
			} else {
				notifi(objData.msg,'error')
			}
        }
    }
}
