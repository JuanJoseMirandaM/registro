<?php 

class ControladorProductos{

	/*==========================================
	=         I   MOSTRAR PRODUCTO             =
	==========================================*/
	
	static public function ctrMostrarProductos($item, $valor){

		$tabla = "producto";
		
		$respuesta = ModeloProductos::MdlMostrarProductos($tabla, $item, $valor);
		//$respuesta = $valor;
		
		return $respuesta;

	}
	static public function ctrMostrarProductosHabilitados($item, $valor){

		$tabla = "producto";
		
		$respuesta = ModeloProductos::MdlMostrarProductosHabilitados($tabla, $item, $valor);
		//$respuesta = $valor;
		
		return $respuesta;

	}

	/*==========================================
	=         I     CREAR PRODUCTO             =
	==========================================*/
	static public function ctrCrearProducto(){
		if (isset($_POST["nuevoCodigo"])) {
			if(preg_match('/^[0-9]+$/', $_POST["nuevoCodigo"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPeso"])){

			   	$tabla = "producto";

				$datos = array("cod_producto" => $_POST["nuevoCodigo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "peso" => $_POST["nuevoPeso"],
							   "bot_x_caja" => $_POST["nuevoBXC"],
							   "litro_x_bot" => $_POST["nuevoLXB"]);
				$resultado = $_GET["resultado"];
				if ($resultado="true") {
					$respuesta = ModeloProductos::MdlIngresarProducto($tabla, $datos);
				}

				if ($respuesta == "ok") {
					echo '<script>
					swal({
						type: "success",
						title: "El producto ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "productos";
						}
					});
				 
					</script>';
				}	
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "La descripcion no puede ir vacia o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "productos";
						}
					});
				 
				</script>';
			}
		}
	}

	/*==========================================
	=         I     EDITAR PRODUCTO              =
	==========================================*/
	public function ctrEditarProducto(){
		if (isset($_POST["editarCodigo"])) {
			if(preg_match('/^[0-9]+$/', $_POST["editarCodigo"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
			   preg_match('/^[0-9-]+$/', $_POST["editarPeso"])
			){

				$tabla = "producto";

				$datos = array("cod_producto" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "peso" => $_POST["editarPeso"],
							   "bot_x_caja" => $_POST["editarBXC"],
							   "litro_x_bot" => $_POST["editarLXB"]);
				$resultado = $_GET["resultado"];
				if ($resultado="true") {
					$respuesta = ModeloProductos::MdlIngresarProducto($tabla, $datos);
				}


				if ($respuesta == "ok") {
					echo '<script>
					swal({
						type: "success",
						title: "El producto ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "productos";
						}
					});
				 
					</script>';
				}
			}
			else{
				echo '<script>
					swal({
						type: "error",
						title: "El producto no puede ir vacio o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "productos";
						}
					});
				 
				</script>';
			}
		}
		
	}

	/*==========================================
	=         I     BORRAR PRODUCTO            =
	==========================================*/
	public function ctrBorrarProducto(){
		if (isset($_GET["idProducto"])) {
			$tabla = "producto";
			$datos = $_GET["idProducto"];

			$respuesta = ModeloProductos::mdlBorrarProducto($tabla, $datos);

			if ($respuesta == "ok") {
				echo '<script>
				swal({
					type: "success",
					title: "El producto ha sido eliminado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location = "productos";
					}
				});
				 
				</script>';
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "El producto no pudo eliminarse",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "productos";
						}
					});
				 
				</script>';
			}
		}
	}
}