<?php 

require_once "conexion.php";

class ModeloNotaRemision{
	/*==========================================
	=          MOSTRAR NOTAS REMISION          =
	==========================================*/
	
	static public function mdlMostrarNotasRemision($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchall();
		}

		

		$stmt -> close();

		$stmt = null;
	}

	/**
 	* REGISTRAR DE COMPROBANTE
 	*/
	static public function mdlIngresarNotaRemision($tabla, $datos){
		//var_dump($datos);
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idNR, automatico, clasificador, cotizacion, estado, fecha, usuario, tipo1, login, moneda, tipo2, sistema, numeroNR, numeroDC, numeroSAP, fcha_registro, origen, destino, cod_Camion, chofer) VALUES (:idNR, :automatico, :clasificador, :cotizacion, :estado, :fecha, :usuario, :tipo1, :login, :moneda, :tipo2, :sistema, :numeroNR, :numeroDC, :numeroSAP, :fcha_registro, :origen, :destino, :placa, :chofer)");

			$stmt -> bindParam(":idNR", $datos["idNR"], PDO::PARAM_STR);
			$stmt -> bindParam(":automatico", $datos["automatico"], PDO::PARAM_STR);
			$stmt -> bindParam(":clasificador", $datos["clasificador"], PDO::PARAM_STR);
			$stmt -> bindParam(":cotizacion", $datos["cotizacion"], PDO::PARAM_STR);
			$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
			$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
			$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":tipo1", $datos["tipo1"], PDO::PARAM_STR);
			$stmt -> bindParam(":login", $datos["login"], PDO::PARAM_STR);
			$stmt -> bindParam(":moneda", $datos["moneda"], PDO::PARAM_STR);
			$stmt -> bindParam(":tipo2", $datos["tipo2"], PDO::PARAM_STR);
			$stmt -> bindParam(":sistema", $datos["sistema"], PDO::PARAM_STR);
			$stmt -> bindParam(":numeroNR", $datos["numeroNR"], PDO::PARAM_STR);
			$stmt -> bindParam(":numeroDC", $datos["numeroDC"], PDO::PARAM_STR);
			$stmt -> bindParam(":numeroSAP", $datos["numeroSAP"], PDO::PARAM_STR);
				date_default_timezone_set('America/La_Paz');
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$fechaActual = $fecha.' '.$hora;
			$stmt -> bindParam(":fcha_registro", $fechaActual, PDO::PARAM_STR);
			$stmt -> bindParam(":origen", $datos["origen"], PDO::PARAM_STR);
			$stmt -> bindParam(":destino", $datos["destino"], PDO::PARAM_STR);
			$stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
			$stmt -> bindParam(":chofer", $datos["chofer"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	

}