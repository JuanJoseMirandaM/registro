<?php 
require_once "../controladores/notasRemision.controlador.php";
require_once "../modelos/notasRemision.modelo.php";
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

// reference the Dompdf namespace
use Dompdf\Dompdf;


class imprimirNR{


public $idNR;

public function traerImpresionidNR(){

$item = "idNR";
$valor = $this->idNR;	
$orden = false;
$respuesta = ControladorNotaRemision::ctrMostrarNotasRemision($item, $valor, $orden);


$itemProvee = "cod_provee";
$valorProvee = $respuesta["cod_Camion"];	

$provee = ControladorProveedores::ctrMostrarProveedores($itemProvee, $valorProvee);

// Instanciamos un objeto de la clase DOMPDF.

$pdf = new Dompdf();
// Definimos el tamaño y orientación del papel que queremos.
$pdf->setPaper('8.5x13', 'portrait');

// Introducimos HTML de prueba

//<<<'ENDHTML'
$html = '
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Nota de Remision</title>
		<style>
			html {
				margin: 0;
			}
			body {
				border: 0px solid black;
				font-family: "Arial", serif;
				margin: 15mm 15mm 10mm 20mm;
				<!--arriba derecha abajo isquierda-->
			}
			hr {
				page-break-after: always;
				border: 0;
				margin: 0;
				padding: 0;
			}
			table {
				width: 100%;

			}
			th{
			  border: 1px solid #000080;
			  border-collapse: collapse;
			  padding: 5px;
			  text-align: left;
			  line-height:5px;
			  background-color:white;
			  font-size:9px;
			}
			td {
			  padding: 3px;
			  text-align: left;
			  line-height:5px;
			  background-color:white;
			  font-size:9px;
			}

			.contenedor{
			  height: 36%;
			  background-color: #FFFFFF;
			  margin: 0% 0%;
			}

			.firmas{
			  height: 13%;
			  background-color: #FFFFFF;
			  margin: 0% 0%;
			}

			#watermark { position: fixed; width: 600px; height: 1200px; margin-left: 120px; margin-top: 0px; opacity: .07; } 

			#header { position: fixed; left: 20mm; top: 15mm; right: 15mm; height: 3mm; background-color: write; text-align: center; }

		    #footer { position: fixed; left: 0px; bottom: 0px; right: 0px; height: 30mm; background-color: write; }

		</style>
		
	</head>

<body>';

if ($respuesta["estado"]=="D") {
	$html .= '<div id="watermark">
		 	<img src="img/diferido2.png" height="100%" width="100%" />
		 </div> ';
}


$html .= '
<div  class="contenedor">
	<table width="100%">
		<tr>

			<td style="width:85%"><b>MERCEDES A. PEÑAFIEL DE CAREAGA</b></td>
			<td style="width:15%"><b>Lugar:</b> LPZ</td>
		</tr>
		<tr>
			<td style="width:85%"><b>Av. Garcia Lanza #60 Zona Achumani</b></td>
			<td style="width:15%"><b>Numero:</b>'.$respuesta["numero"].'</td>
		</tr>
		<tr>
			<td style="width:85%"><b>NIT: 192822026</b></td>
			<td style="width:15%"><b>Fecha:</b> '.$respuesta["fecha"].'</td>
		</tr>
		<tr>
			<td style="width:85%"><b>La Paz - Bolivia</b></td>
			<td style="width:15%"><b>Estado:</b> '.$respuesta["estado"].'</td>
		</tr>
		<tr>
			<td style="width:85%"></td>
			<td style="width:15%"><b>T/C:</b> '.$respuesta["cotizacion"].'</td>
		</tr>

	</table>
	<table>
		<tr>
			<td colspan="3" style=" color:#000080; background-color:white; width:100%">
				<div style="font-size:20px; text-align:center; line-height:15px;">
					<br>
					<b>ALBARAN TRANSPORT</b>
				</div>
			</td>
		</tr>
	</table>


	<br>
	<table style="line-height:5px;">
		<tr>
			<td width="40%"><b>Numero NR</b> '.$respuesta["numeroNR"].'</td>
			<td width="40%"><b>Numero DOC</b> '.$respuesta["numeroDC"].'</td>
			<td width="20%"><b>Nuemro SAP</b> '.$respuesta["numeroSAP"].'</td>
		</tr>
		<tr>
			<td width="40%"><b>Origen:</b> '.$respuesta["origen"].'</td>
			<td width="40%"><b>Destino:</b> '.$respuesta["destino"].'</td>
			<td width="20%"><b>Tipo:</b> '.$respuesta["tipo1"].'</td>
		</tr>
		<tr>
			<td width="40%"><b>Placa:</b> '.$respuesta["placa"].'</td>
			<td colspan="2" width="60%"><b>Contratista:</b> '.$respuesta["cod_Camion"].' - '.$provee["nombre_com"].'</td>
		</tr>
		<tr>
			<td colspan="3" width="100%"><b>Conductor:</b> '.$respuesta["chofer"].'</td>
		</tr>
		<tr>
			<td colspan="3" width="100%"><b>Glosa:</b> '.$respuesta["glosa1"].'</td>
		</tr>
	</table>
	<br>

	<table style="width:100%; padding: 5px;">
	  <tr>
	    <th style="width:20%">CANTIDAD</th>
	    <th style="width:20%">CODIGO</th>
	    <th style="width:60%">DESCRIPCION</th>
	    
	  </tr>';

	$listaProducto = json_decode($respuesta["detalle"], true);
	//var_dump($listaProducto);
	foreach ($listaProducto as $key => $value) {
	 $html .= '<tr>
			    <td>'.$value["cantidad"].'</td>
			    <td>'.$value["codigo"].'</td>
			    <td>'.$value["descripcion"].'</td>
			    
			  </tr>';
	}
	  
	$html .= '</table>
</div>

<div  class="firmas">
	<table style="width:100%; padding: 25px;">
		<tr>
			<td width="35%">
				<div style="font-size:15px; text-align:center; line-height:15px;">
					<br>
					<b>TRANSPORTADO POR</b>
				</div>
				<div style="font-size:10px; text-align:left; line-height:15px;">
					<br>
					<b>Nombre: </b>'.$respuesta["chofer"].'
					<br>
					<b>CI:</b>
					
				</div>
			</td>
			<td width="35%">
				<div style="font-size:15px; text-align:center; line-height:15px;">
					<br>
					<b>DESPACHADO POR</b>
				</div>
				<div style="font-size:10px; text-align:left; line-height:15px;">
					<br>
					<b>Nombre:</b>
					<br>
					<b>CI:</b>
					
				</div>
			</td>
			<td width="30%">
				<div style="font-size:15px; text-align:center; line-height:15px;">
					<br>
					<b>ENTREGADO POR</b>
				</div>
				<div style="font-size:10px; text-align:left; line-height:15px;">
					<br>
					<b>Nombre:</b>
					<br>
					<b>CI:</b>
					
				</div>
			</td>
		</tr>
	</table>
</div>

<div class="contenedor">
	
	<table width="100%">
		<tr>
			<td style="width:85%"><b>MERCEDES A. PEÑAFIEL DE CAREAGA</b></td>
			<td style="width:15%"><b>Lugar:</b> LPZ</td>
		</tr>
		<tr>
			<td style="width:85%"><b>Av. Garcia Lanza #60 Zona Achumani</b></td>
			<td style="width:15%"><b>Numero:</b>'.$respuesta["numero"].'</td>
		</tr>
		<tr>
			<td style="width:85%"><b>NIT: 192822026</b></td>
			<td style="width:15%"><b>Fecha:</b> '.$respuesta["fecha"].'</td>
		</tr>
		<tr>
			<td style="width:85%"><b>La Paz - Bolivia</b></td>
			<td style="width:15%"><b>Estado:</b> '.$respuesta["estado"].'</td>
		</tr>
		<tr>
			<td style="width:85%"></td>
			<td style="width:15%"><b>T/C:</b> '.$respuesta["cotizacion"].'</td>
		</tr>

	</table>
	<table>
		<tr>
			<td colspan="3" style=" color:#000080; background-color:white; width:100%">
				<div style="font-size:20px; text-align:center; line-height:15px;">
					<br>
					<b>ALBARAN TRANSPORT</b>
				</div>
			</td>
		</tr>
	</table>


	<br>
	<table style="line-height:5px;">
		<tr>
			<td width="40%"><b>Numero NR</b> '.$respuesta["numeroNR"].'</td>
			<td width="40%"><b>Numero DOC</b> '.$respuesta["numeroDC"].'</td>
			<td width="20%"><b>Nuemro SAP</b> '.$respuesta["numeroSAP"].'</td>
		</tr>
		<tr>
			<td width="40%"><b>Origen:</b> '.$respuesta["origen"].'</td>
			<td width="40%"><b>Destino:</b> '.$respuesta["destino"].'</td>
			<td width="20%"><b>Tipo:</b> '.$respuesta["tipo1"].'</td>
		</tr>
		<tr>
			<td width="40%"><b>Placa:</b> '.$respuesta["placa"].'</td>
			<td colspan="2" width="60%"><b>Contratista:</b> '.$respuesta["cod_Camion"].' - '.$provee["nombre_com"].'</td>
		</tr>
		<tr>
			<td colspan="3" width="100%"><b>Conductor:</b> '.$respuesta["chofer"].'</td>
		</tr>
		<tr>
			<td colspan="3" width="100%"><b>Glosa:</b> '.$respuesta["glosa1"].'</td>
		</tr>
	</table>
	<br>
	<table style="width:100%; padding: 5px;">
	  <tr>
	    <th style="width:20%">CANTIDAD</th>
	    <th style="width:20%">CODIGO</th>
	    <th style="width:60%">DESCRIPCION</th>
	    
	  </tr>';

	$listaProducto = json_decode($respuesta["detalle"], true);
	//var_dump($listaProducto);
	foreach ($listaProducto as $key => $value) {
	 $html .= '<tr>
			    <td>'.$value["cantidad"].'</td>
			    <td>'.$value["codigo"].'</td>
			    <td>'.$value["descripcion"].'</td>
			    
			  </tr>';
	}
	  
	$html .= '</table>

</div>

<div  class="firmas">
	<table style="width:100%; padding: 25px;">
		<tr>
			<td width="35%">
				<div style="font-size:15px; text-align:center; line-height:15px;">
					<br>
					<b>TRANSPORTADO POR</b>
				</div>
				<div style="font-size:10px; text-align:left; line-height:15px;">
					<br>
					<b>Nombre: </b>'.$respuesta["chofer"].'
					<br>
					<b>CI: </b>
				</div>
			</td>
			<td width="35%">
				<div style="font-size:15px; text-align:center; line-height:15px;">
					<br>
					<b>DESPACHADO POR</b>
				</div>
				<div style="font-size:10px; text-align:left; line-height:15px;">
					<br>
					<b>Nombre:</b>
					<br>
					<b>CI:</b>
				</div>
			</td>
			<td width="30%">
				<div style="font-size:15px; text-align:center; line-height:15px;">
					<br>
					<b>ENTREGADO POR</b>
				</div>
				<div style="font-size:10px; text-align:left; line-height:15px;">
					<br>
					<b>Nombre:</b>
					<br>
					<b>CI:</b>
					
				</div>
			</td>
		</tr>
	</table>
</div>


</body>

</html>';
//ENDHTML;
	//echo $html;
	
// Cargamos el contenido HTML.
$pdf->loadHtml($html);

// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.
$filename = 'notaRemision' . $valor . '.pdf';

// Attachement da vista previa en el navegador
$pdf->stream($filename,array("Attachment"=>0));

}

}

$notaRemision = new imprimirNR();
$notaRemision -> idNR = $_GET["idNR"];



$notaRemision -> traerImpresionidNR();

?>