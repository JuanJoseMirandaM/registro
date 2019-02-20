/*======================================
=          EDITAR PROVEEDOR            =
======================================*/
$(".tablaProveedores").on("click",".btnEditarProvee",function(){
	//$(".btnEditarProvee").click(function(){
	var idProvee = $(this).attr("idProvee");
		

	var datos = new FormData();
	datos.append("idProvee", idProvee);

	$.ajax({
		url:"ajax/proveedores.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			console.log("respuesta Provee", respuesta);
			$("#editarCode").val(respuesta["cod_provee"]);
			$("#editarNombre").val(respuesta["nombre_com"]);
			$("#editarCiD").val(respuesta["ci"]);
			$("#editarFono").val(respuesta["celular"]);
			$("#editarPlaca").val(respuesta["placa_camion"]);
			$("#editarMarca").val(respuesta["marca"]);
			$("#editarChofer").val(respuesta["chofer"]);
			$("#editarCiC").val(respuesta["ci_chofer"]);
			$("#editarFonoChofer").val(respuesta["cel_chofer"]);

			$("#idActual").val(respuesta["idprovee"]);
			$("#nombreActual").val(respuesta["nombre_com"]);

		}

	}); 
})

/*======================================
=          ACTIVAR PROVEEDOR           =
======================================*/
$(".tablaProveedores").on("click",".btnActivarProvee",function(){
	//$(".btnActivarProvee").click(function(){
	var idProvee = $(this).attr("idProvee"); 
	var estadoProvee = $(this).attr("estadoProvee");

	var datos = new FormData();
	datos.append("activarId", idProvee);
	datos.append("activarProvee", estadoProvee);

	$.ajax({
		url:"ajax/proveedores.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			//console.log("resp",respuesta);
		}

	})

	if(estadoProvee == 0){
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoProvee', 1);
	}else{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoProvee', 0);
	}
})

/*========================================
=            ELIMINAR PROVEEDOR          =
========================================*/
$(".tablaProveedores").on("click",".btnEliminarProvee",function(){
	//$(".btnEliminarProvee").click(function(){
	var idProvee = $(this).attr("idProvee");
	swal({
		title: "¿Esta seguro de borrar el proveedor?",
		text: "Si no lo esta puede cancelar la accion!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar proveedor!"	
			
	}).then((result) => {
		if(result.value){
			window.location = "index.php?ruta=proveedores&idProvee="+idProvee+"&resultado="+result.value
		}
	})
		
})
