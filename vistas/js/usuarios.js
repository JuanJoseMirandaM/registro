/*====================================================
=            SUBIENDO LA FOTO DEL USUARIO            =
====================================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	/*===============================================
	=VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG=
	===============================================*/
	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "Cerrar"
		});
	}else if(imagen["size"] > 2000000){
		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "La imagen no debe pesar mas de 2MB!",
			type: "error",
			confirmButtonText: "Cerrar"
		});
	}else{
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){
			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src",rutaImagen);
		})
	}
	
})

/*======================================
=          EDITAR USUARIO              =
======================================*/
//$(".formularioUsuarios").on("click", "button.btnEditarUsuario", function (){

$(".btnEditarUsuario").click(function(){
	var idUsuario = $(this).attr("idUsuario");
		

	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			//console.log("respuesta", respuesta);
			$("#editarCi").val(respuesta["ci"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarFono").val(respuesta["fono"]);

			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);

			$("#ciActual").val(respuesta["ci"]);
			$("#nombreActual").val(respuesta["nombre"]);
			$("#usuarioActual").val(respuesta["usuario"]);
			$("#passwordActual").val(respuesta["password"]);
			$("#fotoActual").val(respuesta["foto"]);

			if(respuesta["foto"]!=""){
				$(".previsualizar").attr("src", respuesta["foto"]);
			}else{
				$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
		}

	}); 
})

/*======================================
=          ACTIVAR USUARIO              =
======================================*/
$(".btnActivar").click(function(){
	var idUsuario = $(this).attr("idUsuario"); 
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
	datos.append("activarId", idUsuario);
	datos.append("activarUsuario", estadoUsuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

		}

	})

	if(estadoUsuario == 0){
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario', 1);
	}else{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario', 0);
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
=            ELIMINAR USUARIO            =
========================================*/
$(".btnEliminarUsuario").click(function(){
	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");
	swal({
		title: "¿Esta seguro de borrar el usuario?",
		text: "Si no lo esta puede cancelar la accion!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar usuario"	
			
	}).then((result)=>{
		if(result.value){
			window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+"&usuario="+usuario+"&resultado="+result.value
		}
	})
		
})
