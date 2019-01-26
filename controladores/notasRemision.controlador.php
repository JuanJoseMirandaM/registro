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
			
			   	$datos = array(	"idNR" => $_POST["nuevoIdNR"],
								"automatico" => $_POST["nuevoNumero"],
								"clasificador" => $_POST["nuevaEmpresa"],
								"cotizacion" => $_POST["nuevoTC"],
								"estado" => "D",
								"fecha" => date('Y/m/d', strtotime($_POST["nuevaFecha"])),
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
								window.location = "crear-notaremision";
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

}

