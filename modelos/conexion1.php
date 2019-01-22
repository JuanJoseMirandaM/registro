<?php 

/**
 * 
 */
class Conexion{
	
	static public function conectar(){
		$usuario = "id8008537_pepe";
		$pass = "7KfFmoRYbGQEuAbNJbnr";
		$link = new PDO("mysql:host=localhost;dbname=id8008537_kangaroo",
						$usuario, $pass);
		
		//$link->exec("set names utf8");

		return $link;

		
	}
}