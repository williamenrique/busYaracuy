document.addEventListener('DOMContentLoaded', function () {
    /**********cargar unidades en mantenimiento en la tabla**********/
    if(document.querySelector('#tableDataMant')){
        $('#tableDataMant').DataTable({
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
                "url": ' ' + base_url + 'Datamant/listDataMant',
                "dataType":'json',
                "dataSrc": ''
            },
            "columns": [
                { 'data': 'id_unidad' },
                { 'data': 'fecha_entrada' },
                { 'data': 'fecha_salida' },
                { 'data': 'diagnostico' },
                { 'data': 'recomendacion' },
                { 'data': 'user_nombres' },
                { 'data': 'opciones' }
            ],
            paging: false,
            scrollCollapse: true,
            scrollY: '50vh',
            dom: 'Bfrtip',
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tableDataMant_wrapper .col-sm-6:eq(0)')
    }
})

const fntDelReg = (idUnidadMantenimiento) => {
    Swal.fire({
        title: 'Estas seguro de eliminar el registro ?',
        text: "No podra ser revertido el proceso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'btn btn-success',
        cancelButtonColor: 'btn btn-danger',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            //usando un if reducido creamos un objeto del contenido en (request)
            let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
            let ajaxUrl = base_url + 'Datamant/delreg/' + idUnidadMantenimiento 
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
                        notifi(objData.msg, 'success')
                        let tableDataMant = $('#tableDataMant').DataTable()
                        tableDataMant.ajax.reload()
                    } else {
                        notifi(objData.msg, 'error')
                    }
                }
            }
        }
    })
}
/********** creamos elregistro de scaner **********/
if(document.querySelector('#formScaner')){
    let formScaner = document.querySelector('#formScaner')
    formScaner.onsubmit = function (e) {
        e.preventDefault()
        //hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
        //usando un if reducido creamos un objeto del contenido en (request)
        let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
        let ajaxUrl = base_url + 'Datamant/setScaner'
        //creamos un objeto del formulario con los datos haciendo referencia a formData
        let formData = new FormData(formScaner) 
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
                    formScaner.reset()
                    notifi(objData.msg, 'success')
                    let strBuscar = document.getElementById('txtBuscar').value
                    buscarReg(strBuscar)
                    //refrescamos el dataTable
                    // let tableScaner = $('#tableScaner').DataTable()
                    //recargamos la tabla 
                    // tableScaner.ajax.reload(function () {
                    //  //cada vez que se haga una accion se recarga la tabla y los botones
                    // })
                } else {
                    notifi(objData.msg, 'error')
                }
            }
        }
    }
}
/**********llenar el select cargamos las unidades en los select**********/
const listUnidades = () => {
    let ajaxUrl = base_url + "Datamant/getUnidades"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#unidadesList').innerHTML = request.responseText
			//seleccionando el primer option
			$("#unidadesList").selectpicker('render')
		}
	}
}
const buscarReg = () =>{
    let strBuscar = document.getElementById('txtBuscar').value
    // buscarReg(strBuscar)
    let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
    let ajaxUrl = base_url + 'Datamant/getRegScaner/' + strBuscar
    let strData = new URLSearchParams("strBuscar=" + strBuscar)
    request.open("POST", ajaxUrl, true)
    //forma en como se enviara
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    //enviamos
    request.send(strData)
    //despues del envio retornamos una funcion con los datos
    request.onreadystatechange = function () {
        //validamos la respuesta del servidor al enviar los datos
        if (request.readyState == 4 && request.status == 200) {
            //obtener el json y convertirlo a un objeto en javascript
            document.getElementById('boxScaner').innerHTML =  request.responseText  
        }
    }
}
// asignarle un evento a la caja de texto
let input = document.getElementById("txtBuscar")
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault()
    document.getElementById("btnBuscar").click()
    let strBuscar = document.getElementById('txtBuscar').value
    buscarReg(strBuscar)
  }
})
let btnBuscar = document.getElementById('btnBuscar')
btnBuscar.addEventListener('click', function(){
    let strBuscar = document.getElementById('txtBuscar').value
    buscarReg(strBuscar)
})
window.addEventListener('load', function () {
    listUnidades()
    buscarReg()
},false)