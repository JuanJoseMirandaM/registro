<?php

require_once "../../../controladores/comprobantes.controlador.php";
require_once "../../../modelos/comprobantes.modelo.php";

require_once "../../../controladores/lincomprobantes.controlador.php";
require_once "../../../modelos/lincomprobante.modelo.php";

require_once "../../../controladores/cuentas.controlador.php";
require_once "../../../modelos/cuentas.modelo.php";

require_once "../../../controladores/analiticos.controlador.php";
require_once "../../../modelos/analiticos.modelo.php";


class imprimirComprobante{

public $codigo;

public function traerImpresionComprobante(){
//TRAEMOS LA INFORMACIÓN DE LA VENTA

$item = "idComprobante";
$valor = $this->codigo;

$respuesta = ControladorComprobantes::ctrMostrarComprobantes($item, $valor);

$numero = $respuesta["numero"];
$fecha = $respuesta["fecha"];
$glosa = $respuesta["glosa1"];
$estado = $respuesta["estado"];
$TC = number_format($respuesta["tipoCambio"],2);



// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// crear un nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//iniciar un grupo de paginas
$pdf->startPageGroup();

//adicionar una nueva pagina
$pdf->addPage();

// ---------------------------------------------------------

// CABECERA
$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="background-color:white; width:300px">

				<div style="font-size:8.5px; text-align:lefth; line-height:15px;">
					<b>
					<br>
					M&D TRANSPORTE NAL. E INTER. SRL
					<br>
					Av. Garcia Lanza #60 Zona Achumani
					<br>
					NIT: 192822026
					<br>
					La PAz - Bolivia
					</b>
				</div>
			</td>
			
			<td style="background-color:white; width:150px"></td>

			<td style="background-color:white; width:90px">
				<div style="font-size:8.5px; text-align:lefth; line-height:15px;">
					<br>
					<b>Numero:</b> $numero
					<br>
					<b>Fecha:</b> $fecha
					<br>
					<b>Estado:</b> $estado
				</div>

			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:15px; text-align:center; line-height:15px;">
					<br>
					<b>COMPROBANTE DE TRASPASO</b>
				</div>
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:20px"></td>
			<td style="background-color:white; width:420px">
				<div style="font-size:8.5px; text-align:lefth; line-height:15px;">
					<br>
					<b>Lugar:</b> LPZ
					<br>
					<b>Glosa:</b> $glosa
				</div>
			</td>
			<td style="background-color:white; width:100px">
				<div style="font-size:8.5px; text-align:lefth; line-height:15px;">
					<br>
					<b>T/Cambio:</b> $TC
				</div>
			</td>	
		</tr>

	</table>
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
//NOMBRE COLUMNAS
$bloque2 = <<<EOF

	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>
	</table>

	<table style="font-size:8.5px; padding:5px 10px;">
		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><b>Cuenta</b></td>
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center"><b>Descripcion</b></td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Debe</b></td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Haber</b></td>
		
		</tr>
		
	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------
//DETALLE COMPROBANTE
$item = "idComprobante";
$valor = $respuesta["idComprobante"];
$lincomprobante = ControladorLinComprobantes::ctrMostrarLinComprobantes($item, $valor);

$debeT = 0;
$haberT = 0;

foreach ($lincomprobante as $key => $value) {
$glosa = $value["glosa"];
$debe = number_format($value["debe"],2);
$haber = number_format($value["haber"],2);

$debeT=$debeT+$value["debe"];
$haberT=$haberT+$value["haber"];

$itemC = "idCuenta";
$valorC = $value["idCuenta"];
$cuenta = ControladorCuentas::ctrMostrarCuentas($itemC, $valorC);

$codigoC = $cuenta["codigo"];
$descripcionC = $cuenta["descripcion"];

if ($value["idAnalitico"]!=NULL) {
$itemA = "idAnalitico";
$valorA = $value["idAnalitico"];
$analitico = ControladorAnaliticos::ctrMostrarAnaliticos2($itemA, $valorA);
$codigoA = $analitico["codigo"];
}else{
$codigoA = "";
}
$bloque3 = <<<EOF

	

	<table style="font-size:8px; padding:5px 10px;">
		<tr>
		
		<td style="background-color:white; width:80px; text-align:lefth">
			<b>$codigoC</b>
			<br>
			$codigoA
		</td>
		<td style="background-color:white; width:260px; text-align:lefth">
			<b>$descripcionC</b>
			<br>$glosa
			
		</td>
		<td style="background-color:white; width:100px; text-align:right">$debe</td>
		<td style="background-color:white; width:100px; text-align:right">$haber</td>
		
		</tr>
		
	</table>

EOF;


$pdf->writeHTML($bloque3, false, false, false, false, '');

}

// ---------------------------------------------------------
//TOTALES
$debeTT = number_format($debeT,2);
$haberTT = number_format($haberT,2);
$bloque4 = <<<EOF

	<table style="font-size:8.5px; padding:5px 10px;">
		<hr>
		<tr>
		
		<td style="background-color:white; width:80px; text-align:center"><b>TOTALES</b></td>
		<td style="background-color:white; width:260px; text-align:center"></td>
		<td style="background-color:white; width:100px; text-align:right"><b>$debeTT</b></td>
		<td style="background-color:white; width:100px; text-align:right"><b>$haberTT</b></td>
		
		</tr>
		
	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
// ---------------------------------------------------------
//FOOTER
/*
$bloque8 = <<<EOF
<footer>
  
  <strong>Copyright &copy; 2018 <a href="https://www.jjsmm.com" target="_blank">Pepe System</a>.</strong> Todos los derechos reservados.
</footer>
EOF;

$pdf->writeHTML($bloque8, false, false, false, false, '');*/
// ---------------------------------------------------------
// Salida
$pdf->Output('comprobante.pdf', 'I');

}

}


$comprobante = new imprimirComprobante();
$comprobante -> codigo = $_GET["codigo"];
$comprobante -> traerImpresionComprobante();
//============================================================+
// END OF FILE
//============================================================+
?>
 