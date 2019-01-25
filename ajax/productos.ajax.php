<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;
  public $activarProducto;

  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductosHabilitados($item, $valor);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "descripcio_largo";
      $valor = $this->nombreProducto;
      $orden = null;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);

    }else{
      $item = "cod_producto";
      $valor = $this->idProducto;
      $orden = null;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);
      
    }



  }
  public function ajaxActivarProducto(){

    $tabla = "producto";
    
    $item1 = "habilitado";
    $valor1 = $this->activarProducto;

    $item2 = "cod_producto";
    $valor2 = $this->activarId;

    $respuesta = ModeloProductos::MdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2);
    //echo json_encode($respuesta);
  }
}


/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["cod_producto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["cod_producto"];
  $editarProducto -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreProducto"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> nombreProducto = $_POST["nombreProducto"];
  $traerProductos -> ajaxEditarProducto();

}

/*======================================
=           ACTIVAR PRODUCTO           =
======================================*/
if (isset($_POST["activarProducto"])) {
  $activarProvee = new AjaxProductos();
  $activarProvee -> activarProducto = $_POST["activarProducto"];
  $activarProvee -> activarId = $_POST["activarId"];
  $activarProvee -> ajaxActivarProducto();
}






