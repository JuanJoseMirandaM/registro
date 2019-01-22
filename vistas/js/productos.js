/*======================================
=          EDITAR PREODUCTO            =
======================================*/
$(".btnEditarProducto").click(function(){
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
			console.log("respuesta_ajax",respuesta);
			
		}

	}); 
})

/*======================================
=          ACTIVAR PRODUCTO            =
======================================*/
$(".btnActivarProducto").click(function(){
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
			console.log("resp",respuesta);
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
/*================================================
=            VALIDAR NO REPERTIR USUARIO         =
================================================*/
$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			//nconsole.log("respuesta","2"+respuesta+"2");
			if (respuesta.length > 7){
				$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>')
				$("#nuevoUsuario").val("");
			}
		}

	})
})
/*========================================
=            ELIMINAR PRODUCTO           =
========================================*/
$(".btnEliminarProducto").click(function(){
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
