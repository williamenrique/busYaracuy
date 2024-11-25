window.addEventListener('load', function () {
    fntOrdenes()
},false)
// TODO:lista de ordenes en tarjetas
if(document.getElementById('boxInvoce')){
	fntOrdenes = () =>{
		//creamos el objeto para os navegadores
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		var ajaxUrl = base_url + "Datamant/getOrdenes"
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
}
const fntRestDesp = (idDesp) => {
    (async () => {
		(async () => {
			const { value: text } = await Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				input: 'textarea',
				inputPlaceholder: 'Observacion por la eliminacion.',
				inputAttributes: {
					'aria-label': 'Observacion por la eliminacion.'
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
				let ajaxUrl = base_url + 'Datamant/restOrden/'
				//id del atributo lr que obtuvimos enla variable
				// let strData = new URLSearchParams("idUnidad="+idUnidad+"&idStatus="+color+"&srtText="+text)
				let strData = new URLSearchParams("idDesp="+idDesp+"&srtText="+text)
				console.log(text)
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
							fntOrdenes()
						}else{
							Swal.fire('Atencion!', objData.msg, 'error')
						}
					}
				}
			}
		})()
		// }
	})()
}