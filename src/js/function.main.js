function soloNumeros(e) {
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = "0123456789";
	especiales = "8-37-39-46";

	tecla_especial = false
	for (var i in especiales) {
		if (key == especiales[i]) {
			tecla_especial = true;
			break;
		}
	}

	if (letras.indexOf(tecla) == -1 && !tecla_especial) {
		return false;
	}
}
function soloLetras(e) {
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = " áéíóúabcdefghijklmnñopqrstuvwxyz.";
	especiales = "8-37-39-46";

	tecla_especial = false
	for (var i in especiales) {
		if (key == especiales[i]) {
			tecla_especial = true;
			break;
		}
	}

	if (letras.indexOf(tecla) == -1 && !tecla_especial) {
		return false;
	}
}
/****
 * funcion para la notificacion
 */
function notifi(data, icon) {
	$(function () {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		})
		Toast.fire({
			icon: icon,
			title: data
		})
	})
}

(function() {
	'use strict';
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
})();

window.onunload = unloadPage;
function unloadPage(){
 alert("unload event detected!");
}
// TODO: generar un respaldo de la base de datos
fntBackup2 = () => {
	// jObject= JSON.stringify(srtPago)
	$.ajax({
		type:'post',
		cache:false,
		url: base_url + "backup/backupData.php",
		// data:{dataTicket:  jObject},
		success: function (server) {
			notifi(server, 'info');
		}
	})
}


fntBackup = () => {
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url + 'backup/backupData.php'
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true);
	//envio de datos del formulario que se almacena enla variable
	request.send();
	//obtenemos los resultados
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//obtenemos los datos y convertimos en JSON
			let objData = JSON.parse(request.responseText)
			//leemos el ststus de la respuesta
			if (objData.status) {
				notifi(objData.msg, 'success')
			} else {
				notifi(objData.msg, 'error')
			}
		}
	}
}