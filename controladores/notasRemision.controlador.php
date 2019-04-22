<?php 


class ControladorNotaRemision{

	/*==========================================
	=          MOSTRAR NotasRemision           =
	==========================================*/
	static public function ctrMostrarNotasRemision($item, $valor, $orden){
		$tabla = "notaremision";
		
		$respuesta = ModeloNotaRemision::MdlMostrarNotasRemision($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*==========================================
	=         I     CREAR NOTA REMISION        =
	==========================================*/
	static public function ctrCrearNotasRemision(){

		if (isset($_POST["nuevoIdNR"])) {

			if( preg_match('/^[0-9 ]+$/', $_POST["nuevoNR"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["nuevoDC"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["nuevoSAP"]) 
			){ 	
			    
			   	$tabla = "notaremision";
				$date = $_POST["nuevaFecha"];
				$dateinput = explode('/', $date);
				$ukdate = $dateinput[2].'/'.$dateinput[1].'/'.$dateinput[0];
				var_dump($ukdate);
				//$fecha = $date->format('Y/m/d');
				
			   	$datos = array(	"idNR" => $_POST["nuevoIdNR"],
								"automatico" => $_POST["nuevoCodigo"],
								"clasificador" => $_POST["nuevaEmpresa"],
								"cotizacion" => $_POST["nuevoTC"],
								"estado" => "D",
								"fecha" => $ukdate,
								"usuario" => $_POST["nuevoUsuario"],
								"glosa1" => $_POST["nuevaGlosa"],
								"tipo1" => $_POST["nuevaFlete"],
								"login" => $_POST["idUsuario"],
								"moneda" => $_POST["nuevaMoneda"],
								"numero" => $_POST["nuevoNumero"],
								"tipo2" => $_POST["nuevoTipo"],
								"sistema" => "Registra",
								"numeroNR" => $_POST["nuevoNR"],
								"numeroDC" => $_POST["nuevoDC"],
								"numeroSAP" => $_POST["nuevoSAP"],
								"origen" => $_POST["nuevoOrigen"],
								"destino" => $_POST["nuevoDestino"],
								"placa" => $_POST["nuevaPlacaCamion"],
								"cod_Camion" => $_POST["nuevoCodCamion"],
								"chofer" => $_POST["nuevoChofer"],
								
								"detalle" => $_POST["listaProductos"]

				);
			   	//var_dump($datos["fecha"]);
				$respuesta = ModeloNotaRemision::mdlIngresarNotaRemision($tabla, $datos);
				
				if ($respuesta == "ok") {
					echo '<script>
						swal({
							type: "success",
							title: "La Nota de Remision ha sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "notaremision";
							}
						});
					 
					</script>';
				}else{
					echo '<script>
						swal({
							type: "error",
							title: "La Nota de Remision no pudo ser guardada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "crear-notaremision";
							}
						});
					 
					</script>';
				}
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "Ningun campo puede ir vacio o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "crear-notaremision";
						}
					}); 
				</script>';
			}
		}
	}

	/*==========================================
	=         I   EDITAR  NOTA REMISION        =
	==========================================*/
	static public function ctrEditarNotasRemision(){

		if (isset($_POST["editarIdNR"])) {

			if( preg_match('/^[0-9 ]+$/', $_POST["nuevoNR"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["nuevoDC"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["nuevoSAP"]) 
			){ 	
			    
			   	$tabla = "notaremision";
				$date = $_POST["nuevaFecha"];
				$dateinput = explode('/', $date);
				$ukdate = $dateinput[2].'/'.$dateinput[1].'/'.$dateinput[0];

			   	$datos = array(	"idNR" => $_POST["editarIdNR"],
								"automatico" => $_POST["nuevoNumero"],
								"clasificador" => $_POST["nuevaEmpresa"],
								"cotizacion" => $_POST["nuevoTC"],
								"estado" => "D",
								"fecha" => $ukdate,
								"usuario" => $_POST["nuevoUsuario"],
								"glosa1" => $_POST["nuevaGlosa"],
								"tipo1" => $_POST["nuevaFlete"],
								"login" => $_POST["idUsuario"],
								"moneda" => $_POST["nuevaMoneda"],
								"tipo2" => $_POST["nuevoTipo"],
								"sistema" => "Registra",
								"numeroNR" => $_POST["nuevoNR"],
								"numeroDC" => $_POST["nuevoDC"],
								"numeroSAP" => $_POST["nuevoSAP"],
								"origen" => $_POST["nuevoOrigen"],
								"destino" => $_POST["nuevoDestino"],
								"placa" => $_POST["nuevaPlacaCamion"],
								"cod_Camion" => $_POST["nuevoCodCamion"],
								"chofer" => $_POST["nuevoChofer"],
								"detalle" => $_POST["listaProductos"]

				);

				$respuesta = ModeloNotaRemision::mdlEditarNotaRemision($tabla, $datos);
				
				if ($respuesta == "ok") {
					echo '<script>
						swal({
							type: "success",
							title: "La Nota de Remision ha sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "notaremision";
							}
						});
					 
					</script>';
				}else{
					echo '<script>
						swal({
							type: "error",
							title: "La Nota de Remision no pudo ser guardada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "index.php?ruta=editar-notaremision&idNR="'.$_POST["editarIdNR"].'"";
							}
						});
					 
					</script>';
				}
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "Ningun campo puede ir vacio o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "index.php?ruta=editar-notaremision&idNR="'.$_POST["editarIdNR"].'"";
						}
					}); 
				</script>';
			}
		}
	}

	/*==========================================
	=         I     POSTEAR NOTA REMISION      =
	==========================================*/
	public function ctrPostearNR(){
		if (isset($_GET["idPNR"])) {
			$tabla = "notaremision";
			

			$datos = array(	"idNR" => $_GET["idPNR"],
							"estado" => "P"
					);
			$resultado = $_GET["resultado"];

			if ($resultado="true") {
				$respuesta = ModeloNotaRemision::mdlPostearNR($tabla, $datos);

	            $listaProducto = json_decode($NR["detalle"], true);
              	//value[cantidad], value[codigo], value[descripcion]
              	foreach ($listaProducto as $key => $value) {
              		
              	}
			}
			

			if ($respuesta == "ok") {
				echo '<script>
				swal({
					type: "success",
					title: "La nota de remision fue posteada correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location = "notaremision";
					}
				});
				 
				</script>';
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "La nota de remision no pudo postearse",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "notaremision";
						}
					});
				 
				</script>';
			}
		}
	}
}

