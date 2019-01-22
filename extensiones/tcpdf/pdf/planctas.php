<?php

require_once "../../../controladores/cuentas.controlador.php";
require_once "../../../modelos/cuentas.modelo.php";
require_once('tcpdf_include.php');



class imprimirComprobante{

public $codigo;

public function traerImpresionComprobante(){
//TRAEMOS LA INFORMACIÓN DE LA VENTA



// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// crear un nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);







// set default header data(datos)
$pdf->SetHeaderData('MD.jpg', 25, 'M&D TRANSPORTE NAL. E INTER. SRL
', 'Av. Garcia Lanza #60 Zona Achumani
NIT: 192822026
La Paz - Bolivia');
//$pdf->SetHeaderData($bloque1);

// set header and footer fonts(tipo de letra)
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set margins(margenes)
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//iniciar un grupo de paginas
$pdf->startPageGroup();

//adicionar una nueva pagina
$pdf->addPage();

// CABECERA
// ---------------------------------------------------------
$fechaActual = date("d/m/Y");
$bloque1 = <<<EOF
	<table>
		
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:15px; text-align:center; line-height:15px;">
					<br>
					<b>PLAN DE CUENTAS</b>
				</div>
			</td>
		</tr>
	</table>
EOF;
//SetHeaderData
$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
//NOMBRE COLUMNAS
$bloque2 = <<<EOF

	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>		
		</tr>
	</table>

	<table style="font-size:7px; padding:5px 10px;">
		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><b>CUENTA</b></td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center"><b>ANALITICO</b></td>
		<td style="border: 1px solid #666; background-color:white; width:250px; text-align:center"><b>DESCRIPCION</b></td>
		<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center"><b>NIVEL</b></td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><b>MONEDA</b></td>
		
		</tr>
		
	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------
//DETALLE COMPROBANTE
$item = NULL;
$valor = NULL;
$cuentas = ControladorCuentas::ctrMostrarCuentas($item, $valor);


foreach ($cuentas as $key => $value) {

$codigo = $value["codigo"];
$tipoA = $value["tipoAnalitico"];
$nivel = $value["nivel"];
$descripcion = $value["descripcion"];
$moneda = $value["moneda"];
if ($tipoA == null) {
		$tipoA = "";
}
$bloque3 = <<<EOF

	

	<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="background-color:white; width:80px; text-align:lefth">$codigo</td>
		<td style="background-color:white; width:60px; text-align:lefth">$tipoA</td>
		<td style="background-color:white; width:250px; text-align:lefth">$descripcion</td>
		<td style="background-color:white; width:70px; text-align:right">$nivel</td>
		<td style="background-color:white; width:80px; text-align:right">$moneda</td>
		</tr>
	</table>

EOF;


$pdf->writeHTML($bloque3, false, false, false, false, '');

}

// ---------------------------------------------------------
$pdf->Output('Plan Ctas.pdf', 'I');

}

}


$comprobante = new imprimirComprobante();
//$comprobante -> codigo = $_GET["codigo"];
$comprobante -> traerImpresionComprobante();
//============================================================+
// END OF FILE
//============================================================+
?>
 