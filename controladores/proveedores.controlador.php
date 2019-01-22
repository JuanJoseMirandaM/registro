 	<?php 

class ControladorProveedores{

	/*==========================================
	=         I     CREAR PROVEEDOR            =
	==========================================*/
	static public function ctrCrearProveedor(){
		if (isset($_POST["nuevoNombre"])) {
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[0-9-]+$/', $_POST["nuevoFono"])){
			   	
			    
			   	$tabla = "proveedor";	

				$datos = array("codigo" => $_POST["nuevoCodigo"],
							   "nombre" => $_POST["nuevoNombre"],
							   "fono" => $_POST["nuevoFono"],
							   "placa" => $_POST["nuevaPlaca"],
							   "marca" => $_POST["nuevaMarca"],
							   "chofer" => $_POST["nuevoChofer"],
							   "celu" => $_POST["nuevoCelu"]);
				//var_dump($datos);

				$respuesta = ModeloProveedores::MdlIngresarProveedor($tabla, $datos);

				if ($respuesta == "ok") {
					echo '<script>
					swal({
						type: "success",
						title: "El proveedor ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "proveedores";
						}
					});
				 
					</script>';
				}	
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "El proveedor no puede ir vacio o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "proveedores";
						}
					});
				 
				</script>';
			}
		}
	}

	/*==========================================
	=         I   MOSTRAR PROVEDORES           =
	==========================================*/
	static public function ctrMostrarProveedores($item, $valor){
		$tabla = "proveedor";
		
		$respuesta = ModeloProveedores::MdlMostrarProveedores($tabla, $item, $valor);
		//var_dump($respuesta);
		return $respuesta;

	}


	/*==========================================
	=         I     EDITAR USUARIO              =
	==========================================*/
	public function ctrEditarUsuario(){
		if (isset($_POST["editarUsuario"])) {
			if(preg_match('/^[0-9]+$/', $_POST["editarCi"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[0-9-]+$/', $_POST["editarFono"])
			){
				

			   	if ($_POST["editarPassword"]!="") {
			   		if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
			   			$encriptar = crypt($_POST["editarPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');	
			   		}else{
			   			echo '<script>
						swal({
							type: "error",
							title: "La contraseña no puede ir vacia o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "usuarios";
							}
						});
				 
						</script>';
			   		}
			   	}else{
			   		$encriptar = $_POST["passwordActual"];
			   	}

			   	$tabla = "usuario";

				$datos = array("ci" => $_POST["editarCi"],
							   "nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "foto" => $ruta,
							   "fono" => $_POST["editarFono"],
							   "perfil" => $_POST["editarPerfil"]);
				$respuesta = ModeloUsuarios::MdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {
					echo '<script>
					swal({
						type: "success",
						title: "El usuario ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "usuarios";
						}
					});
				 
					</script>';
				}
			}
			else{
				echo '<script>
					swal({
						type: "error",
						title: "El usuario no puede ir vacio o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "usuarios";
						}
					});
				 
				</script>';
			}
		}
		
	}

	/*==========================================
	=         I     BORRAR PROVEEDOR           =
	==========================================*/
	public function ctrBorrarProvee(){
		if (isset($_GET["idProvee"])) {
			$tabla = "proveedor";
			$datos = $_GET["idProvee"];
			$resultado = $_GET["resultado"];
			if ($resultado="true") {
				$respuesta = ModeloProveedores::mdlBorrarProveedor($tabla, $datos);
			}
			

			if ($respuesta == "ok") {
				echo '<script>
				swal({
					type: "success",
					title: "El proveedor ha sido eliminado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location = "proveedores";
					}
				});
				 
				</script>';
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "El proveedor no pudo eliminarse",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "proveedores";
						}
					});
				 
				</script>';
			}
		}
	}
}

