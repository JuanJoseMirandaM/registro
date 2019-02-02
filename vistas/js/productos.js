/*======================================
=          EDITAR PREODUCTO            =
======================================*/
$(".tablaProductos").on("click",".btnEditarProducto",function(){
    //$(".btnEditarProducto").click(function(){
	var cod_producto = $(this).attr("idProducto");
	
	var datos = new FormData();
	datos.append("cod_producto", cod_producto);
	//console.log("respuesta",cod_producto);
	
	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			//console.log("respuesta_ajax",respuesta);
			$("#editarCodigo").val(respuesta["cod_producto"]);
			$("#editarDescripcion").val(respuesta["descripcion_largo"]);
			$("#editarPeso").val(respuesta["peso"]);
			$("#editarBXC").val(respuesta["bot_x_caja"]);
			$("#editarLXB").val(respuesta["litro_x_bot"]);

			$("#codigoActual").val(respuesta["cod_producto"]);
			$("#descripcionActual").val(respuesta["descripcion_largo"]);
			$("#pesoActual").val(respuesta["peso"]);
			$("#BXCActual").val(respuesta["bot_x_caja"]);
			$("#LXBActual").val(respuesta["litro_x_bot"]);
		}

	}); 
})

/*======================================
=          ACTIVAR PRODUCTO            =
======================================*/
$(".tablaProductos").on("click",".btnActivarProducto",function(){
	//$(".btnActivarProducto").click(function(){
	var cod_producto = $(this).attr("idProducto"); 
	var estadoProducto = $(this).attr("estadoProducto");

	var datos = new FormData();
	datos.append("activarId", cod_producto);
	datos.append("activarProducto", estadoProducto);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			//console.log("resp",respuesta);
		}

	})

	if(estadoProducto == 0){
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoProducto', 1);
	}else{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoProducto', 0);
	}
})

/*========================================
=            ELIMINAR PRODUCTO           =
========================================*/
$(".tablaProductos").on("click",".btnEliminarProducto",function(){
	//$(".btnEliminarProducto").click(function(){
	var idProducto = $(this).attr("idProducto");
	
	swal({
		title: "¿Esta seguro de borrar el producto?",
		text: "Si no lo esta puede cancelar la accion!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar producto"	
			
	}).then((result)=>{
		if(result.value){
			window.location = "index.php?ruta=productos&idProducto="+idProducto+"&resultado="+result.value
		}
	})
		
})
