<?php 

require_once "conexion.php";

class ModeloProveedores{
	/**
 	* MOSTRAR PROVEEDORES
 	*/
	
	static public function mdlMostrarProveedores($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchall();
		}

		

		$stmt -> close();

		$stmt = null;
	}

	/**
 	* REGISTRO DE PROVEEDORES
 	*/
	static public function mdlIngresarProveedor($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cod_provee, nombre_com, ci, celular, placa_camion, marca, chofer, ci_chofer, cel_chofer, habilitado) VALUES (:cod_provee, :nombre_com, :ci, :celular, :placa_camion, :marca, :chofer, :ci_chofer, :cel_chofer, 0)");

		$stmt -> bindParam(":cod_provee", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre_com", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":ci", $datos["ci"], PDO::PARAM_STR);
		$stmt -> bindParam(":celular", $datos["fono"], PDO::PARAM_STR);
		$stmt -> bindParam(":placa_camion", $datos["placa"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":chofer", $datos["chofer"], PDO::PARAM_STR);
		$stmt -> bindParam(":ci_chofer", $datos["ci_chofer"], PDO::PARAM_STR);
		$stmt -> bindParam(":cel_chofer", $datos["celu"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	/**
 	* EditarDE USUARIOS
 	*/
	static public function mdlEditarProveedor($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cod_provee = :cod_provee, nombre_com = :nombre_com, ci = :ci, celular = :celular, placa_camion = :placa_camion, marca = :marca, chofer = :chofer, ci_chofer = :ci_chofer, cel_chofer = :cel_chofer WHERE idprovee = :idprovee" );

		$stmt -> bindParam(":idprovee", $datos["idprovee"], PDO::PARAM_STR);
		$stmt -> bindParam(":cod_provee", $datos["cod_provee"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre_com", $datos["nombre_com"], PDO::PARAM_STR);
		$stmt -> bindParam(":ci", $datos["ci"], PDO::PARAM_STR);
		$stmt -> bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":placa_camion", $datos["placa_camion"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":chofer", $datos["chofer"], PDO::PARAM_STR);
		$stmt -> bindParam(":ci_chofer", $datos["ci_chofer"], PDO::PARAM_STR);
		$stmt -> bindParam(":cel_chofer", $datos["cel_chofer"], PDO::PARAM_STR);
		

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	/**
 	* ACTUALIZAR estado DE PROVEEDORES
 	*/
	static public function mdlActualizarProveedor($tabla, $item1, $valor1, $item2, $valor2){
		#UPDATE `usuario` SET `estado` = '1' WHERE `usuario`.`idUsuario` = 2;
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2" );

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	/**
 	* BORRAR PROVEEDOR
 	*/
	static public function mdlBorrarProveedor($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where idprovee = :id" );

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

}