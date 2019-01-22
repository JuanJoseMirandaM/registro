<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Comprobante
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="comprobantes"><i class="fa fa-dashboard"></i>Comprobantes</a></li>
      <li class="active">Editar Comprobante</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!--=====================================
      =              Formulario               =
      ======================================-->
      
      <div class="col-lg-12">
        <form action="" role="form" method="post" class="formularioComprobantes">
          <!--=======================================
          =                 CABECERA                =
          ========================================-->
          <div class="box box-success">
            
              
              <div class="box-header with-border"></div>

              <div class="box-body">
                     

                  
                  <div class="form-group row">
                    <?php 
                      $item = "idComprobante";
                      $valor = $_GET["idComprobante"];

                      $comprobante = ControladorComprobantes::ctrMostrarComprobantes($item, $valor);
                      
                      $itemU = "idUsuario";
                      $valorU = $comprobante["idUsuario"]; 
                      $usuario = ControladorUsuarios::ctrMostrarUsuarios($itemU, $valorU);
                      
                      $itemS = "idSucursal";
                      $valorS = $comprobante["idSucursal"];
                      $sucursal = ControladorSucursales::ctrMostrarSucursales($itemS, $valorS);

                      $itemE = "idEmpresa";
                      $valorE = $sucursal["idEmpresa"];
                      $empresa = ControladorEmpresas::ctrMostrarEmpresas($itemE, $valorE);
                      
                    ?>
                    <div class="col-lg-2" style="padding-right: 0px">
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" class="form-control" id="nuevaEmpresa" name="nuevaEmpresa" value="<?php echo $empresa["nombre"]." - ".$sucursal["nro"] ?>" readonly>
                        <input type="hidden" class="form-control nuevoIdS" id="idSucursal" name="idSucursal" value="<?php echo $comprobante["idSucursal"] ?>">     
                      </div>
                    </div>

                    <div class="col-lg-2" style="padding-right: 0px">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control  nuevoUsuario" id="nuevoUsuario" name="nuevoUsuario" value="<?php echo $usuario["nombre"]; ?>" readonly>
                        <input type="hidden" class="nuevoIdU" name="idUsuario" id="idUsuario" value="<?php echo $comprobante["idUsuario"] ?>">    
                      </div>
                    </div>

                  </div>


                  <div class="form-group row ">
                    <!-- -->
                    
                    <div class="col-lg-2" style="padding-right: 0px">
                    
                      <div class="input-group">
                        
                        <label>Tipo</label>
                        
                        <input type="text" class="form-control nuevoTipo" id="nuevoTipo" name="nuevoTipo"  value="<?php echo $comprobante["tipo"] ?>" required>

                      </div>  

                      <div class="input-group">
                        
                        <label>Moneda</label>
                        <div  class="input-group">
                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                          <select id="nuevaMoneda" name="nuevaMoneda" class="form-control input-sm nuevaMoneda">
                            <option value="<?php echo $comprobante["moneda"] ?>"><?php echo $comprobante["moneda"] ?></option>
                            <option value="BS">Bs</option>
                            <option value="SU">$us</option>
                            <option value="UFV">UFV's</option>
                          </select>
                        </div>

                      </div>   

                    </div>

                    <div class="col-lg-2" style="padding-right: 0px">
                    
                      <div class="input-group">
                        
                        <label>Numero</label>
                        
                        <input type="text" class="form-control nuevoNumero" id="nuevoNumero" name="nuevoNumero"  value="<?php echo $comprobante["numero"] ?>" required>
                        
                        <input type="hidden" class="form-control nuevoIdC" id="nuevoIdComprobante" name="nuevoIdComprobante" value="<?php echo $comprobante["idComprobante"] ?>">
                        
                      </div>  

                      <div class="input-group">
                        
                        <label>T/C</label>
                        
                        <input type="text" class="form-control nuevoTC" id="nuevoTC" name="nuevoTC"  value="N/S" required>

                      </div>   

                    </div>

                    <div class="col-lg-2" style="padding-right: 0px">
                      <label>Fecha</label>

                      <div class="input-group date">
                        
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-rigft nuevaFecha" id="datepicker" name="nuevaFecha" value="<?php echo $comprobante["fecha"] ?>">

                      </div>  

                      <div class="input-group">
                        
                        <label>Ajuste</label>
                        
                        <input type="text" class="form-control nuevoAjuste" id="nuevoAjuste" name="nuevoAjuste"  value="<?php echo $comprobante["ajuste"] ?>" required>

                      </div>   

                    </div>

                    <!-- ESTADO-->
                    <div class="col-lg-3">

                      <label>Estado</label>
                      
                      <div class="radio">
                        <label>
                          <input type="radio" name="nuevoEstado" id="nuevoEstado" value="P" checked>Posteado
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="nuevoEstado" id="nuevoEstado" value="D">Diferido
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="nuevoEstado" id="" value="A" disabled>Anulado
                        </label>
                      </div>

                    </div>
                  </div>

                  <div class="form-group row">   
                    <!-- GLOSA-->
                    <div class="col-lg-5" style="padding-right:  0px">

                      <div class="input-group">
                        
                        <label>Glosa</label>
                        
                        <textarea class="form-control nuevaGlosa1" name="nuevaGlosa1" id="nuevaGlosa1" cols="100" rows="2" ><?php echo $comprobante["glosa1"] ?></textarea>
                        

                      </div>

                    </div>

                  </div>


            
              </div>


          </div>

          <!--=======================================
          =                 DETALLE                 =
          ========================================-->
          <div class="box box-danger">

              <!--=======================================
              =             CABECERA DETALLE            =
              ========================================-->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover tablaCrearComprobante">
                    <thead>
                      <tr>
                        <th width="20">#</th>
                        <th WIDTH="200">Cuenta</th>
                        <th WIDTH="200">Analitico</th>
                        <th WIDTH="450">Glosa</th>
                        <th WIDTH="130">Debe</th>
                        <th WIDTH="130">Haber</th>
                        <th WIDTH="170">Flujo</th>
                        
                      </tr>
                    </thead>
                    <tbody>  
                      <?php 
                      $item = "idComprobante";
                      $valor = $_GET["idComprobante"];
                      $lincomprobante = ControladorLinComprobantes::ctrMostrarLinComprobantes($item, $valor);

                        //var_dump($lincomprobante);
                        foreach ($lincomprobante as $key => $value1) {
                          $itemC = "idCuenta";
                          $valorC = $value1["idCuenta"];
                          $cuenta = ControladorCuentas::ctrMostrarCuentas($itemC, $valorC);

                          
                          echo '<tr>
                                  <td>'.
                                    ($key+1)
                                  .'</td>
                                  <td>'.$cuenta["codigo"].' - '.$cuenta["descripcion"].'</td>';
                                  if ($value1["idAnalitico"]!=NULL) {
                                    $itemA = "idAnalitico";
                                    $valorA = $value1["idAnalitico"];
                                    $analitico = ControladorAnaliticos::ctrMostrarAnaliticos2($itemA, $valorA);
                                    
                                    echo'<td>'.$analitico["codigo"].'</td>';
                                  }else{
                                    echo'<td></td>';
                                  }
                                  
                          echo  '<td>'.$value1["glosa"].'</td>
                                  <td>'.$value1["debe"].'</td>
                                  <td>'.$value1["haber"].'</td>
                                    
                              </tr>';
                        }
                      ?>
                    </tbody>
                </table>  
              </div>
              
              <div class="box-footer">
                  
                  <button type="submit" class="btn btn-primary pull-right  GuardarLinComprobantes">Imprimir</button>

              </div>
          </div>
        <?php 

          $crearComprobante = new  ControladorComprobantes();
          $crearComprobante -> ctrCrearComprobante();

        ?>
        </form>
      </div>

      

  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->