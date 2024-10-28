document.addEventListener('DOMContentLoaded', function () {
	getOperativo()
	getOperatividad()
},false)

function getOperativo(){
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + 'Home/getOperativo'
	//prepara los datos por ajax preparando el dom
	request.open('GET', ajaxUrl, true)
	//hacemos el envio al servidor
	request.send()
	//obtenemos los resultados y evaluamos
	var panelFlota = document.querySelector('.panelFlota')
	request.onreadystatechange = function () { 
		if (request.readyState == 4 && request.status == 200) {
			document.querySelector('.panelFlota').innerHTML = request.responseText
		}
	}
}

function getOperatividad(){
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + 'Home/getOperatividad'
	//prepara los datos por ajax preparando el dom
	request.open('GET', ajaxUrl, true)
	//hacemos el envio al servidor
	request.send()
	//obtenemos los resultados y evaluamos
	request.onreadystatechange = function () { 
		if (request.readyState == 4 && request.status == 200) {
			document.querySelector('.operatividad').innerHTML = request.responseText
		}
	}
}