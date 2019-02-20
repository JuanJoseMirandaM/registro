<?php 

require_once "conexion.php";

class ModeloNotaRemision{
	/*==========================================
	=          MOSTRAR NOTAS REMISION          =
	==========================================*/
	
	static public function mdlMostrarNotasRemision($tabla, $item, $valor, $orden){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}else if($orden == true){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY idNR ASC");

			$stmt -> execute();

			return $stmt -> fetchall();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY idNR DESC");

			$stmt -> execute();

			return $stmt -> fetchall();
		}

		

		$stmt -> close();

		$stmt = null;
	}

	/*==========================================
	=         REGISTRAR NOTAS REMISION         =
	==========================================*/
	static public function mdlIngresarNotaRemision($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idNR, automatico, clasificador, cotizacion, estado, fecha, usuario, glosa1,  tipo1, login, moneda, numero, tipo2, sistema, numeroNR, numeroDC, numeroSAP, fcha_registro, origen, destino, placa, cod_Camion, chofer, detalle) VALUES (:idNR, :automatico, :clasificador, :cotizacion, :estado, :fecha, :usuario, :glosa1, :tipo1, :login, :moneda, :numero, :tipo2, :sistema, :numeroNR, :numeroDC, :numeroSAP, :fcha_registro, :origen, :destino, :placa, :cod_Camion, :chofer, :detalle)");

			$stmt -> bindParam(":idNR", $datos["idNR"], PDO::PARAM_STR);
			$stmt -> bindParam(":automatico", $datos["automatico"], PDO::PARAM_STR);
			$stmt -> bindParam(":clasificador", $datos["clasificador"], PDO::PARAM_STR);
			$stmt -> bindParam(":cotizacion", $datos["cotizacion"], PDO::PARAM_STR);
			$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
			$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
			$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":glosa1", $datos["glosa1"], PDO::PARAM_STR);
			$stmt -> bindParam(":tipo1", $datos["tipo1"], PDO::PARAM_STR);
			$stmt -> bindParam(":login", $datos["login"], PDO::PARAM_STR);
			$stmt -> bindParam(":moneda", $datos["moneda"], PDO::PARAM_STR);
			$stmt -> bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
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
			$stmt -> bindParam(":cod_Camion", $datos["cod_Camion"], PDO::PARAM_STR);
			$stmt -> bindParam(":chofer", $datos["chofer"], PDO::PARAM_STR);
			$stmt -> bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);

		//var_dump($stmt);	
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	
	/*==========================================
	=           EDITAR NOTAS REMISION          =
	==========================================*/
	static public function mdlEditarNotaRemision($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET automatico = :automatico, clasificador = :clasificador, cotizacion = :cotizacion, estado = :estado, fecha = :fecha, usuario = :usuario, glosa1 = :glosa1,  tipo1 = :tipo1, login = :login, moneda = :moneda, tipo2 = :tipo2, sistema = :sistema, numeroNR = :numeroNR, numeroDC = :numeroDC, numeroSAP = :numeroSAP, origen = :origen, destino = :destino, placa = :placa, cod_Camion = :cod_Camion, chofer = :chofer, detalle = :detalle WHERE idNR = :idNR");

			$stmt -> bindParam(":idNR", $datos["idNR"], PDO::PARAM_STR);
			$stmt -> bindParam(":automatico", $datos["automatico"], PDO::PARAM_STR);
			$stmt -> bindParam(":clasificador", $datos["clasificador"], PDO::PARAM_STR);
			$stmt -> bindParam(":cotizacion", $datos["cotizacion"], PDO::PARAM_STR);
			$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
			$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
			$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":glosa1", $datos["glosa1"], PDO::PARAM_STR);
			$stmt -> bindParam(":tipo1", $datos["tipo1"], PDO::PARAM_STR);
			$stmt -> bindParam(":login", $datos["login"], PDO::PARAM_STR);
			$stmt -> bindParam(":moneda", $datos["moneda"], PDO::PARAM_STR);
			$stmt -> bindParam(":tipo2", $datos["tipo2"], PDO::PARAM_STR);
			$stmt -> bindParam(":sistema", $datos["sistema"], PDO::PARAM_STR);
			$stmt -> bindParam(":numeroNR", $datos["numeroNR"], PDO::PARAM_STR);
			$stmt -> bindParam(":numeroDC", $datos["numeroDC"], PDO::PARAM_STR);
			$stmt -> bindParam(":numeroSAP", $datos["numeroSAP"], PDO::PARAM_STR);	
			$stmt -> bindParam(":origen", $datos["origen"], PDO::PARAM_STR);
			$stmt -> bindParam(":destino", $datos["destino"], PDO::PARAM_STR);
			$stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
			$stmt -> bindParam(":cod_Camion", $datos["cod_Camion"], PDO::PARAM_STR);
			$stmt -> bindParam(":chofer", $datos["chofer"], PDO::PARAM_STR);
			$stmt -> bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);

		//var_dump($stmt);	
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*==========================================
	=          POSTEAR NOTAS REMISION          =
	==========================================*/
	static public function mdlPostearNR($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE idNR = :idNR");

			$stmt -> bindParam(":idNR", $datos["idNR"], PDO::PARAM_STR);
			$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
			

		//var_dump($stmt);	
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
}
