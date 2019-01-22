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
					<b>Fecha:</b> $fechaActual
				</div>

			</td>
		</tr>
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