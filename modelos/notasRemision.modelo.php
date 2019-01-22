<?php 

require_once "conexion.php";

class ModeloNotaRemision{
	/**
 	* MOSTRAR notasRemision
 	*/
	
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
 	* REGISTRO DE COMPROBANTE
 	*/
	static public function mdlIngresarComprobante($tabla, $datos){
		//var_dump($datos);
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idComprobante, ajuste, moneda, tipoCambio, estado, fecha, idUsuario, glosa1, numero, tipo, idSucursal, fechaRegistro) VALUES (:idComprobante, :ajuste, :moneda, :tipoCambio, :estado, :fecha, :idUsuario, :glosa1, :numero, :tipo, :idSucursal, :fechaRegistro)");
		$stmt -> bindParam(":idComprobante", $datos["idComprobante"], PDO::PARAM_STR);
		$stmt -> bindParam(":ajuste", $datos["ajuste"], PDO::PARAM_STR);
		$stmt -> bindParam(":moneda", $datos["moneda"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipoCambio", $datos["tipoCambio"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":glosa1", $datos["glosa1"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":idSucursal", $datos["idSucursal"], PDO::PARAM_STR);
		date_default_timezone_set('America/La_Paz');
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');
						$fechaActual = $fecha.' '.$hora;
		$stmt -> bindParam(":fechaRegistro", $fechaActual , PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	

}