<?php 


class ControladorNotaRemision{

	/*==========================================
	=          MOSTRAR NotasRemision           =
	==========================================*/
	static public function ctrMostrarNotasRemision($item, $valor){
		$tabla = "notaremision";
		
		$respuesta = ModeloNotaRemision::MdlMostrarNotasRemision($tabla, $item, $valor);

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
								"placa" => $_POST["nuevaPlaca"],
								//"cod_Camion" => $_POST[""],
								"chofer" => $_POST["nuevoChofer"]

				);

				$respuesta = ModeloNotaRemision::mdlIngresarNotaRemision($tabla, $datos);
				
				if ($respuesta == "ok") {
					/*===================================
					=            GUARDAR LIN            =
					===================================					
					if(isset($_POST["nuevaCuenta"])){

						$items1 = $_POST["nuevaCuenta"];
						$items2 = $_POST["nuevoAnalitico"];
						$items3 = $_POST["nuevaGlosa"];
						$items4 = $_POST["nuevoDebe"];
						$items5 = $_POST["nuevoHaber"];
						$items6 = $_POST["nuevoFlujo"];

					// SEPARAR VALORES DE ARRAYS
					while(true) {

					    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
					    $item1 = current($items1);
					    $item2 = current($items2);
					    $item3 = current($items3);
					    $item4 = current($items4);
					    $item5 = current($items5);
					    $item6 = current($items6);
					    
					    $tabla2 = "lincomprobante";

					    $datos2 = array(
					    	"idComprobante" => $_POST["nuevoIdComprobante"],
							"idCuenta" => $item1,
							"idAnalitico" => $item2,
							"glosa" => $item3,
							"debe" => $item4,
							"haber" => $item5,
							"flujo" => $item6
						);

					    $respuesta2 = ModeloLinComprobante::mdlIngresarLinC($tabla2, $datos2);
					    // Up! Next Value
					    $item1 = next( $items1 );
					    $item2 = next( $items2 );
					    $item3 = next( $items3 );
					    $item4 = next( $items4 );
					    
					    // Check terminator
					    if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
	    
					}
			
					}
					if ($respuesta2 == "ok") {*/

						echo '<script>
						swal({
							type: "success",
							title: "El comprobante cabecera ha sido guardado correctamente",
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
							type: "success",
							title: "El comprobante ha sido guardado, sin un detalle",
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
				//}
				//echo json_encode($respuesta);	
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "La glosa no puede ir vacia o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "crear-comprobante";
						}
					});
				 
				</script>';
			}
		}
	}


}

