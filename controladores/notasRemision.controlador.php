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
	=         I     CREAR COMPROBANTE          =
	==========================================*/
	static public function ctrCrearComprobante(){

		if (isset($_POST["nuevoIdComprobante"])) {
			if( preg_match('/^[0-9]+$/', $_POST["idSucursal"])&&
				preg_match('/^[0-9]+$/', $_POST["idUsuario"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ& ]+$/', $_POST["nuevoTipo"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["nuevaMoneda"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["nuevoNumero"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["nuevoTC"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["nuevoAjuste"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["nuevaGlosa1"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["nuevoEstado"]) 
			){ 	
			    
			   	$tabla = "comprobante";

			   	$datos = array("idComprobante" => $_POST["nuevoIdComprobante"],
					"ajuste" => $_POST["nuevoAjuste"],
					"moneda" => $_POST["nuevaMoneda"],
					"tipoCambio" => "6.96",
					"estado" => $_POST["nuevoEstado"],
					"fecha" => date('Y/m/d', strtotime($_POST["nuevaFecha"])),
					"idUsuario" => $_POST["idUsuario"],
					"glosa1" => $_POST["nuevaGlosa1"],
					"numero" => $_POST["nuevoNumero"],
					"tipo" => $_POST["nuevoTipo"],
					"idSucursal" => $_POST["idSucursal"]

				);

				$respuesta = ModeloComprobantes::mdlIngresarComprobante($tabla, $datos);
				
				if ($respuesta == "ok") {
					/*===================================
					=            GUARDAR LIN            =
					===================================*/					
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
					if ($respuesta2 == "ok") {
						echo '<script>
						swal({
							type: "success",
							title: "El comprobante ha sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "crear-comprobante";
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
								window.location = "crear-comprobante";
							}
						});
					 
						</script>';
					}
				}
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

