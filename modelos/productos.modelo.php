<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla" );

			$stmt -> execute();

			return $stmt -> fetchall();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarProductosHabilitados($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE habilitado = 1");

			$stmt -> execute();

			return $stmt -> fetchall();

		}

		$stmt -> close();

		$stmt = null;

	}

 	/*=============================================
			REGISTRO DE PRODUCTOS
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cod_producto,descripcion_largo, peso, bot_x_caja, litro_x_bot) VALUES (:cod_producto, :descripcion, :peso, :bot_x_caja, :litro_x_bot)");
		$stmt -> bindParam(":cod_producto", $datos["cod_producto"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt -> bindParam(":bot_x_caja", $datos["bot_x_caja"], PDO::PARAM_STR);
		$stmt -> bindParam(":litro_x_bot", $datos["litro_x_bot"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_largo = :descripcion, peso = :peso, bot_x_caja = :bot_x_caja, litro_x_bot = :litro_x_bot WHERE cod_producto = :cod_producto");

		$stmt -> bindParam(":cod_producto", $datos["cod_producto"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt -> bindParam(":bot_x_caja", $datos["bot_x_caja"], PDO::PARAM_STR);
		$stmt -> bindParam(":litro_x_bot", $datos["litro_x_bot"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cod_producto = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	



}