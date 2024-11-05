document.addEventListener('DOMContentLoaded', function () {
	getOperativo()
	getOperatividad()
},false)

const getOperativo = () =>{
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

const getOperatividad = () =>{
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
let btnImp = document.getElementById('btnImp')
btnImp.addEventListener('click', function(){
    $.ajax({
        type:'post',
        cache:false,
        url: base_url + "Home/fntImpOperatividad",
        // data:{dataTicket:  jObject},
        success:function(server){
            console.log(server)//cuando reciva la respuesta lo imprimo
        },
        error: function(xhr) {
            notifi('Ocurrio un error', 'error')
        }
	})
})