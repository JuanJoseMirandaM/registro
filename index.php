<?php  
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/proveedores.controlador.php";
require_once "controladores/notasRemision.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/proveedores.modelo.php";
require_once "modelos/notasRemision.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();