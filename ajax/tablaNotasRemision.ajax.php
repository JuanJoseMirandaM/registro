<?php 
require_once "../controladores/notasRemision.controlador.php";
require_once "../modelos/notasRemision.modelo.php";


class TablaNotasRemision{
	
	/*=============================================
	=            MOSTRAR TABLA CUENTAS            =
	=============================================*/
	public function mostrarTabla(){
		$item = null;
        $valor = null;
        $orden = false;
        $notasRemision = ControladorNotaRemision::ctrMostrarNotasRemision($item, $valor, $orden);

        echo '{
		  "data": [';

		  for ($i=0; $i < count($notasRemision)-1; $i++) { 
		        //$fecha = date_format($notasRemision[$i]["fecha"], '%d/%m/%Y');
		        $fecha = $notasRemision[$i]["fecha"];
		  		echo '[
			      "'.($i+1).'",

			      "'.$notasRemision[$i]["clasificador"].'",
			      "'.$notasRemision[$i]["automatico"].'",
			      "'.$fecha.'",
			      "'.$notasRemision[$i]["tipo1"].'",
			      
			      "'.$notasRemision[$i]["numeroNR"].'",
			      "'.$notasRemision[$i]["numeroDC"].'",
			      "'.$notasRemision[$i]["numeroSAP"].'",
			      "'.$notasRemision[$i]["origen"].'-'.$notasRemision[$i]["destino"].'",';
			      /*"'.$notasRemision[$i]["placa"].'",
			      "'.$notasRemision[$i]["chofer"].'",*/
			      echo '"'.$notasRemision[$i]["idNR"].'",
			      "'.$notasRemision[$i]["estado"].'"
			    ],';
		  	}	

		  echo '[
			      "'.count($notasRemision).'",
			      "'.$notasRemision[count($notasRemision)-1]["clasificador"].'",
			      "'.$notasRemision[count($notasRemision)-1]["automatico"].'",
			      "'.$notasRemision[count($notasRemision)-1]["fecha"].'",
			      "'.$notasRemision[count($notasRemision)-1]["tipo1"].'",
			      
			      "'.$notasRemision[count($notasRemision)-1]["numeroNR"].'",
			      "'.$notasRemision[count($notasRemision)-1]["numeroDC"].'",
			      "'.$notasRemision[count($notasRemision)-1]["numeroSAP"].'",
			      "'.$notasRemision[count($notasRemision)-1]["origen"].'-'.$notasRemision[count($notasRemision)-1]["destino"].'",
			      "'.$notasRemision[count($notasRemision)-1]["idNR"].'",
			      "'.$notasRemision[count($notasRemision)-1]["estado"].'"
			      
			    ]
			]
		}';
	}
}

/*=============================================
=          ACTIVAR TABLA NOTAS DE REMISION    =
=============================================*/

$activar = new TablaNotasRemision();
$activar -> mostrarTabla();
