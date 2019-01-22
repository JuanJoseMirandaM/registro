<?php 
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";
/**
 * 
 */
class AjaxProveedores{
	/*======================================
	=            EDITAR PROVEEDOR          =
	======================================*/
	public $idProvee;

	public function ajaxEditarProvee(){
		$item = "idprovee";
		$valor = $this->idProvee;
		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);
		echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
	}

	/*======================================
	=           ACTIVAR PROVEEDOR          =
	======================================*/
	public $activarId;
	public $activarProvee;

	public function ajaxActivarProvee(){

		$tabla = "proveedor";
		
		$item1 = "habilitado";
		$valor1 = $this->activarProvee;

		$item2 = "idprovee";
		$valor2 = $this->activarId;

		$respuesta = ModeloProveedores::MdlActualizarProveedor($tabla, $item1, $valor1, $item2, $valor2);
		//echo json_encode($respuesta); 
	}
}

/*======================================
=            EDITAR PROVEE             =
======================================*/
if (isset($_POST["idProvee"])) {
	$editar = new AjaxProveedores();
	$editar -> idProvee = $_POST["idProvee"];
	$editar -> ajaxEditarProvee();
}

/*======================================
=           ACTIVAR PROVEEDOR          =
======================================*/
if (isset($_POST["activarProvee"])) {
	$activarProvee = new AjaxProveedores();
	$activarProvee -> activarProvee = $_POST["activarProvee"];
	$activarProvee -> activarId = $_POST["activarId"];
	$activarProvee -> ajaxActivarProvee();
}