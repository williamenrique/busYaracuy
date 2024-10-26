document.addEventListener('DOMContentLoaded', function () {
	/**********cargar flota en la tabla**********/
	if(document.querySelector('#listTickets')){
		$("#listTickets").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": true,
			pageLength: 10,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible",
				"sInfo": "Total  _TOTAL_ ",
				"sInfoEmpty": "Registros 0 ",
				"sInfoFiltered": "(total de _MAX_ registros)",
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
			"bPaginate": false,
			"pagingType": "simple",
			"ajax": {
				"url": ' ' + base_url + 'Estacion/getLastTicket',
				"dataSrc": ''
			},
			paging: false,
			scrollCollapse: true,
			scrollY: '50vh',
			"columns": [
				// { 'data': 'id_ticket' },
				// { 'data': 'fecha_ticket' },
				// { 'data': 'hora_ticket' }
				{ 'data': 'ticket' }
			],
		})
	}
})
// efectuar una venta
if (document.querySelector('#formVenta')) {
	let formUnidad = document.querySelector('#formVenta')
	formVenta.onsubmit =  (e) => {
		e.preventDefault()
		let listDetal = document.querySelector('#listDetal').innerHTML = ""
		let srtNombre = document.querySelector('#txtNombre').value
		let srtCI = document.querySelector('#txtCI').value
		let srtListTipoVehiculo = document.querySelector('#txtListTipoVehiculo').value
		let srtLTS = document.querySelector('#txtLTS').value
		let srtListTipoPago = document.querySelector('#txtListTipoPago').value
		let srtFecha = document.querySelector('#txtFecha').value
		let srtHora = document.querySelector('#txtHora').value
		let srtPlaca = document.querySelector('#txtPlaca').value
		let srtMonto = document.querySelector('#txtMonto').value
		let srtNombreOperador = document.querySelector('#txtNombreOperador').value
		//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
		//usando un if reducido creamos un objeto del contenido en (request)
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		let ajaxUrl = base_url + 'Estacion/setVenta'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formVenta)
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
					document.querySelector('#txtNombre').value = ""
					document.querySelector('#txtCI').value = ""
					document.querySelector('#txtListTipoPago').selectedIndex  = 0
					document.querySelector('#txtListTipoVehiculo').selectedIndex  = 0
					document.querySelector('#txtLTS').value = ""
					document.querySelector('#txtPlaca').value = ""
					document.querySelector('#txtMonto').value = ""
					let listTickets = $('#listTickets').DataTable();
					listTickets.ajax.reload();
					notifi(objData.msg, 'success')
					// manadr a imprimir el ticket de la venta
					fntImprimir(objData.nTicket, srtNombre, srtCI, srtListTipoVehiculo, srtLTS, srtListTipoPago, srtFecha, srtHora, srtNombreOperador,srtPlaca,srtMonto)
					fntCargarDetalle()
				} else {
					notifi(objData.msg, 'error')
				}
			}
		}
	}
}
// TODO: recibimos los datos para imprimir el ticket de venta
fntImprimir = (intTicket, srtNombre, srtCI, srtListTipoVehiculo, srtLTS, srtListTipoPago, srtFecha, srtHora,srtNombreOperador,srtPlaca,srtMonto) => {
	var saveData = Array() //Declaro el arreglo
    saveData['srtNombre'] = srtNombre
    saveData['srtCI'] = srtCI
    saveData['srtLTS'] = srtLTS
    saveData['intTicket'] = intTicket
    saveData['srtListTipoVehiculo'] = srtListTipoVehiculo
    saveData['srtListTipoPago'] = srtListTipoPago
    saveData['srtFecha'] = srtFecha
    saveData['srtHora'] = srtHora
    saveData['srtNombreOperador'] = srtNombreOperador
    saveData['srtPlaca'] = srtPlaca
    saveData['srtMonto'] = srtMonto
    //Lo convierto a objeto
    var jObject={}
    for(i in saveData){
        jObject[i] = saveData[i]
    }
    //Luego lo paso por JSON  a un archivo php llamado js.php
    jObject= JSON.stringify(jObject)
    $.ajax({
		type:'post',
		cache:false,
		url: base_url + "ticket.php",
		data:{dataTicket:  jObject},
		success:function(server){
			console.log(server)//cuando reciva la respuesta lo imprimo
		}
    })
}
// obtener los ultimos ticket
lastTicket = () => {
	let ajaxUrl = base_url + "Estacion/getLastTicket"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("POST", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('.listTickets').innerHTML = request.responseText
		}
	}
}
//funcion para un ticket
fntTicket = (idTicket) => {
	let ajaxUrl = base_url + "Estacion/getTicket/" + idTicket
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("POST", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		//todo va bien 
		if (request.readyState == 4 && request.status == 200) {
			let objData = JSON.parse(request.responseText)
			let intTicket = objData.id_ticket_venta
			let srtNombre = objData.nombre_ticket
			let srtCI = objData.ci_ticket
			let srtListTipoVehiculo = objData.tipo_vehiculo_ticket
			let srtLTS = objData.lts_ticket
			let srtListTipoPago = objData.tipo_pago_ticket
			let srtFecha = objData.fecha_ticket
			let srtHora = objData.hora_ticket
			let srtPlaca = objData.placa_ticket
			let srtMonto = objData.monto_ticket

			let srtNombreOperador = objData.user_nombres
			fntImprimir(intTicket, srtNombre, srtCI, srtListTipoVehiculo, srtLTS, srtListTipoPago, srtFecha, srtHora,srtNombreOperador,srtPlaca,srtMonto)
		}else{
			notifi('Error de impresion verifique la impresora','error')
		}
	}
}
// lista de tipo de de pago
var select = document.getElementById('txtListTipoPago')
select.addEventListener('change', function () {
    var selectedOption = this.options[select.selectedIndex]
	let tasa = document.querySelector('#txtTasa').value
	let lts = document.querySelector('#txtLTS').value
	let monto = document.querySelector('#txtMonto')
	if(selectedOption.value == 4){
		let montoP = 0.5 * lts
		document.querySelector('#txtMonto').value = montoP
	}
	if(selectedOption.value == 5){
		let montoP = lts * 0.5 * tasa 
		document.querySelector('#txtMonto').value = montoP
	}
	if(selectedOption.value == 6){
		let montoP = lts * 0.5 * tasa 
		document.querySelector('#txtMonto').value = montoP
	}
})
// actualizar la tasa del dia
document.querySelector('.btnUpdateTasa').addEventListener('click', () => {
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let tasa = document.querySelector('#txtTasa').value
	let ajaxUrl = base_url + 'Estacion/updateTasa/' + tasa
	//creamos un objeto del formulario con los datos haciendo referencia a formData
	let strData = "tasa=" + tasa;
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true)
	//envio de datos del formulario que se almacena enla variable
	request.send(strData)
	//despues del envio retornamos una funcion con los datos
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			//obtener el json y convertirlo a un objeto en javascript
			var objData = JSON.parse(request.responseText)
			if(objData.status){
				notifi(objData.msg, 'info')

			}
		}
	}	
})
// caragar en el input la tasa
cargarTasa = () => {
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + 'Estacion/getTasa'
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
			document.querySelector('#txtTasa').value = objData.tasa_dia
		}
	}
}
// cancelar venta
fntCancelar = () => {
	document.querySelector('#txtNombre').value = ""
	document.querySelector('#txtCI').value = ""
	document.querySelector('#txtListTipoPago').selectedIndex  = 0
	document.querySelector('#txtListTipoVehiculo').selectedIndex  = 0
	document.querySelector('#txtLTS').value = ""
}
// cargar lista detalle d venta
fntCargarDetalle = () => {
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + 'Estacion/getDetail'
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true)
	//envio de datos del formulario que se almacena enla variable
	request.send()
	//despues del envio retornamos una funcion con los datos
	let listDetal = document.querySelector('#listDetal')
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			//obtener el json y convertirlo a un objeto en javascript
			listDetal.innerHTML = request.responseText
		}
	}
}
// para el cierre
fntCierre = () => {
	//usando un if reducido creamos un objeto del contenido en (request)
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + 'Estacion/cierreDia'
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
				let listTickets = $('#listTickets').DataTable()
				listTickets.ajax.reload();
				notifi(objData.msg, 'success')
				fntImprimirCierre(objData.dataCierre)
				fntCargarDetalle()
				// fntBackup()
			} else {
				notifi(objData.msg, 'error')
			}
		}
	}
}
// imprimir el ticket de venta
fntImprimirCierre = (srtPago) => {
    jObject= JSON.stringify(srtPago)
    $.ajax({
			type:'post',
			cache:false,
			url: base_url + "cierredia.php",
			data:{dataTicket:  jObject},
			success:function(server){
				//console.log(server)//cuando reciva la respuesta lo imprimo
			}
    })
}
// cargar en un alista los cierres pendientes
fntCierrePendiente = () => {
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + 'Estacion/cierreP'
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true)
	//envio de datos del formulario que se almacena enla variable
	request.send()
	//despues del envio retornamos una funcion con los datos
	let cierrP = document.querySelector('#cierrePendiente')
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			//obtener el json y convertirlo a un objeto en javascript
			cierrP.innerHTML = request.responseText
		}
	}
}
// realizar el cierre resagado
fntCierreP = (fechaActiva) => {
	// cierrePendiente
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + 'Estacion/cierrePendiente/' + fechaActiva
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true)
	//envio de datos del formulario que se almacena enla variable
	request.send()
	//despues del envio retornamos una funcion con los datos
	// let cierrP = document.querySelector('.cierrP')
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			//obtener el json y convertirlo a un objeto en javascript
			var objData = JSON.parse(request.responseText)
			//condionamos la respuesta del array del controlador
			if (objData.status) { 
				fntImprimirCierre(objData.dataCierre)
				fntCierrePendiente()
				// fntBackup()
			}
		}
	}
}
window.addEventListener('load', () => {
	cargarTasa()
	fntCargarDetalle()
	fntCierrePendiente()
}, false)
// mantener el reloj funcionando
mueveReloj = (dateObject = new Date()) => {
	let hours = dateObject.getHours()
	hours = hours < 10 ? "0" + hours.toString() : hours
	let minutes = dateObject.getMinutes()
	minutes = minutes < 10 ? "0" + minutes.toString() : minutes
	let seconds = dateObject.getSeconds()
	seconds = seconds < 10 ? "0" + seconds.toString() : seconds
	let horaImprimible =  hours + ":" + minutes + ":" + seconds
	document.getElementById("txtHora").value = horaImprimible
	setTimeout("mueveReloj()",1000)
}

//TODO: generar pdf
fntIraReporte = (srtDate) => {
    let ajaxUrl = base_url + "Estacion/reportePdf/" + srtDate
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
// TODO: generar un respaldo de la base de datos
fntBackup = () => {
    // jObject= JSON.stringify(srtPago)
    $.ajax({
			type:'post',
			cache:false,
			url: base_url + "backup/backupData.php",
			// data:{dataTicket:  jObject},
			success:function(server){
				console.log(server)//cuando reciva la respuesta lo imprimo
			}
    })
}