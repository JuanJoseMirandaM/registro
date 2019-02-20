<?php

//antes de hacer los cálculos, compruebo que el usuario está logueado 
//utilizamos el mismo script que antes 
if ($_SESSION["iniciarSesion"] != "ok") { 
    //si no está logueado lo envío a la página de autentificación 
    session_destroy();

    echo '<<script>
      window.location = "ingreso";
    </script>';
} else { 
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    date_default_timezone_set('America/La_Paz');
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $ahora = $fecha.' '.$hora;
    //$ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
    if($tiempo_transcurrido >= 6000) { 
      //si pasaron 10 minutos o más
      session_destroy(); 
      echo '<script>
        swal({
          type: "warning",
          title: "Su sesión ha expirado. Para continuar, deberá conectarse nuevamente.",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
        }).then((result)=>{
          if(result.value){
            window.location = "ingreso";
          }
        });
         
      </script>';
     
      
      //echo '<<script>
      //  window.location = "ingreso";
      //</script>';
    }else { 
      $_SESSION["ultimoAcceso"] = $ahora;
    }  
} 
?>