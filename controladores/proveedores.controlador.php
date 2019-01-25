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
	public function ctrEditarProveedor(){
		if (isset($_POST["editarCode"])) {
			if(preg_match('/^[0-9]+$/', $_POST["editarCode"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[0-9-]+$/', $_POST["editarFono"])
			){
				
				$tabla = "proveedor";
				
				$datos = array("idprovee" => $_POST["idActual"],
							   "cod_provee" => $_POST["editarCode"],
							   "nombre_com" => $_POST["editarNombre"],
							   "celular" => $_POST["editarFono"],
							   "placa_camion" => $_POST["editarPlaca"],
							   "marca" => $_POST["editarMarca"],
							   "chofer" => $_POST["editarChofer"],
							   "cel_chofer" => $_POST["editarFonoChofer"]
							   );

				
				$respuesta = ModeloProveedores::MdlEditarProveedor($tabla, $datos);

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
			}
			else{
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

