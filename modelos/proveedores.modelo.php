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
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cod_provee, nombre_com, celular, placa_camion, marca, chofer, cel_chofer, habilitado) VALUES (:cod_provee, :nombre_com, :celular, :placa_camion, :marca, :chofer, :cel_chofer, 1)");

		$stmt -> bindParam(":cod_provee", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre_com", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":celular", $datos["fono"], PDO::PARAM_STR);
		$stmt -> bindParam(":placa_camion", $datos["placa"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":chofer", $datos["chofer"], PDO::PARAM_STR);
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
	static public function mdlEditarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ci = :ci ,nombre = :nombre , usuario = :usuario , password = :password, foto = :foto , fono = :fono , perfil = :perfil WHERE usuario = :usuario" );

		$stmt -> bindParam(":ci", $datos["ci"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":fono", $datos["fono"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		

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