<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Notas de Remision
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="notaremision"><i class="fa fa-dashboard"></i>Notas de Remision</a></li>
      <li class="active">Editar Notas de Remision</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!--=====================================
      =              Formulario               =
      ======================================-->
      
      <div class="col-lg-12">
        <form action="" role="form" method="post" class="formularioNR">
          <!--=======================================
          =                 CABECERA                =
          ========================================-->
          <div class="box box-success">
            
            <div class="box-header with-border"></div>

            <div class="box-body">
                     
              <div class="form-group row">
                <?php

                    $item = "idNR";
                    $valor = $_GET['idNR'];
                    $orden = true;

                    $NR = ControladorNotaRemision::ctrMostrarNotasRemision($item, $valor, $orden);
                    //var_dump($NR);
                
                ?>
                <div class="col-lg-3  col-sm-4 col-xs-10" style="padding-right: 0px">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <select name="nuevaEmpresa" id="nuevaEmpresa" class="form-control  nuevaEmpresa" style="width: 100%;" required>
                      <option value="CO-HL-MPM-LPZ" selected>Mercedes Penafiel Mogro</option>
                      <option value="CO-HL-MD-LPZ">M&D Transporte</option>

                    </select>     
                  </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-10" style="padding-right: 0px">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control  nuevoUsuario" id="nuevoUsuario" name="nuevoUsuario" value="<?php echo $NR["usuario"]; ?>" readonly>
                    <input type="hidden" class="nuevoIdU" name="idUsuario" id="idUsuario" value="<?php echo $NR["login"]; ?>">    
                  </div>
                </div>

              </div>

              <div class="form-group row ">
                    
                <div class="col-lg-2 col-sm-2 col-xs-6" style="padding-right: 0px">
                    
                  <div class="input-group col-lg-12 col-sm-12 col-xs-12">
                        
                    <label>Tipo</label>
                    <select name="nuevaTipo" id="nuevoTipo" class="form-control  nuevoTipo" style="width: 100%;" required>
                      <option value="NR">Nota Remision</option>
                    </select>

                  </div>

                  <label>Fecha</label>

                  <div class="input-group date col-lg-12 col-sm-12 col-xs-12">
                        
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-rigft nuevaFecha" id="datepicker" name="nuevaFecha" value="<?php echo $NR["fecha"]; ?>">

                  </div>
                      
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-6" style="padding-right: 0px">
                    
                  <div class="input-group">
                        
                    <label>Numero</label>
                    

                      <input type="text" class="form-control nuevoNumero" id="nuevoNumero" name="nuevoNumero" required readonly value="<?php echo $NR["automatico"]; ?>">
                  
                      <input type="hidden" class="form-control editarIdNR" id="editarIdNR" name="editarIdNR" value="<?php echo $NR["idNR"]; ?>">
                    
                        
                  </div>

                  <div class="input-group">
                        
                    <label>Numero NR</label>
                    <input type="text" class="form-control nuevoNR" id="nuevoNR" name="nuevoNR"  placeholder="Numero NR" required value="<?php echo $NR["numeroNR"]; ?>">

                  </div>


                </div>

                <div class="col-lg-2 col-sm-2 col-xs-6" style="padding-right: 0px">
                    
                  <div class="input-group  col-lg-12 col-sm-12 col-xs-12">
                        
                    <label>Moneda</label>
                    <select name="nuevaMoneda" id="nuevaMoneda" class="form-control  nuevaMoneda" style="width: 100%;" required>
                      <option value="BS">Bolivianos</option>
                    </select> 
                        
                  </div> 
                  
                  <div class="input-group">
                    <label>Numero DC</label>  
                    <input type="text" class="form-control nuevoDC" id="nuevoDC" name="nuevoDC"  placeholder="Numero DC" required value="<?php echo $NR["numeroDC"]; ?>">
                  </div>

                </div>

                <div class="col-lg-2 col-sm-2 col-xs-6" style="padding-right: 0px">
                  <div class="input-group">
                        
                    <label>T/C</label>
                        
                    <input type="text" class="form-control nuevoTC" id="nuevoTC" name="nuevoTC"  value="6.96" required readonly>

                  </div> 

                  <div class="input-group">
                        
                    <label>Numero SAP</label>
                        
                    <input type="text" class="form-control nuevoSAP" id="nuevoSAP" name="nuevoSAP"  placeholder="Numero SAP" required value="<?php echo $NR["numeroSAP"]; ?>">

                  </div>   

                </div>

              </div>

              <div class="form-group row">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Flete de</label>
                <div class="col-lg-2 col-sm-2 col-xs-8">
                  <select name="nuevaFlete" id="nuevaFlete" class="form-control  nuevaFlete" style="width: 100%;" required>
                    <option value="<?php echo $NR["tipo1"]; ?>" selected><?php echo $NR["tipo1"]; ?></option>
                    <option value="IDA">Ida</option>
                    <option value="RETORNO">Retorno</option>
                    <option value="DE IDA Y VUELTA">Ida y vuelta</option>
                  </select>
                </div>
                <label class="col-lg-1 col-sm-1 col-xs-2 col-form-label">Origen</label>
                <div class="col-lg-2 col-sm-3 col-xs-4">
                  <select name="nuevoOrigen" id="nuevoOrigen" class="form-control  nuevoOrigen" style="width: 100%;" required>
                    <option value="<?php echo $NR["origen"]; ?>" selected><?php echo $NR["origen"]; ?></option>
                    <option value="LPZ" >La Paz</option>
                    <option value="ORU">Oruro</option>
                    <option value="CBB">Cochabamba</option>
                    <option value="SCZ">Santa Cruz</option>
                    <option value="POT">Potosi</option>
                    <option value="SUC">Sucre</option>
                    <option value="TAR">Tarija</option>
                  </select>
                </div>
                <label class="col-lg-1 col-sm-1 col-xs-2 col-form-label">Destino</label>
                <div class="col-lg-2 col-sm-3 col-xs-4">
                  <select name="nuevoDestino" id="nuevoDestino" class="form-control  nuevoDestino" style="width: 100%;" required>
                    <option value="<?php echo $NR["destino"]; ?>" selected><?php echo $NR["destino"]; ?></option>
                    <option value="LPZ">La Paz</option>
                    <option value="ORU">Oruro</option>
                    <option value="CBB">Cochabamba</option>
                    <option value="SCZ">Santa Cruz</option>
                    <option value="POT">Potosi</option>
                    <option value="SUC">Sucre</option>
                    <option value="TAR">Tarija</option>
                  </select>
                </div>
              </div>
              <?php
                $item = 'cod_provee';
                $valor = $NR["cod_Camion"];

                $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);
                //var_dump($proveedor);
              ?>
              <div class="form-group row ">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Transporte</label>
                <div class="col-lg-2 col-sm-4 col-xs-8">
                  <select name="nuevaPlaca" id="nuevaPlaca" class="form-control  nuevaPlaca select2" style="width: 100%;" required>
                    <option value="<?php echo $proveedor["idprovee"]; ?>"><?php echo $NR["placa"]; ?></option>
                    <?php
                      $item = null;
                      $valor = null;

                      $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                      foreach ($proveedores as $key => $value) {
                        $placa = $value["placa_camion"];
                        if ($value["habilitado"]==1) {
                          echo '<option value="'.$value["idprovee"].'">'.$placa.'</option>';
                        }else{
                          echo '<option value="'.$value["idprovee"].'" disabled>'.$placa.'</option>';
                        }
                        
                      }
                    ?>
                  </select>
                  
                </div>
                
                <div class="col-lg-4 col-sm-6 col-xs-12 ">
                  <input type="text" class="form-control nuevoDueno" id="nuevoDueno" name="nuevoDueno" value="<?php echo $proveedor["nombre_com"]; ?>" readonly required>
                  <input type="hidden" class="nuevoCodCamion" id="nuevoCodCamion" name="nuevoCodCamion" value="<?php echo $NR["cod_Camion"]; ?>">
                  <input type="hidden" class="nuevaPlacaCamion" id="nuevaPlacaCamion" name="nuevaPlacaCamion" value="<?php echo $NR["placa"]; ?>">
                </div>

                
              </div>

              <div class="form-group row">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Conductor</label>
                <div class="col-lg-6 col-sm-10 col-xs-8">
                  <input type="text" class="form-control nuevoChofer" id="nuevoChofer" name="nuevoChofer" value="<?php echo $NR["chofer"]; ?>" required>
                </div>
              </div>
              
              <div class="form-group row">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Glosa</label>
                <div class="col-lg-6 col-sm-10 col-xs-8">
                  <textarea class="form-control" rows="3" id="nuevaGLosa" name="nuevaGlosa" ><?php echo $NR["glosa1"]; ?></textarea>
                </div>
              </div>
               
            </div>
          </div>

          <!--=======================================
          =                 DETALLE                 =
          ========================================-->
          <div class="box box-danger">

            <div class="box-header with-border">
              <button type="button" class="btn btn-primary pull-left AgregarDetNR btnAgregarProducto">Agregar</button>
            </div>
              
            <!--=======================================
              =             CABECERA DETALLE            =
              ========================================-->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover tablaCrearNR">
                <thead>
                  <tr>
                    <th width="10"></th>
                    <th WIDTH="150">Cantidad</th>
                    <th WIDTH="270">Codigo</th>
                    <th WIDTH="600">Detalle</th>                 
                  </tr>
                </thead>
              </table>  
            </div>
            <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
            ======================================--> 

            <div class="form-group row nuevoProducto">

            <?php 

              $listaProducto = json_decode($NR["detalle"], true);
              //var_dump($listaProducto);
              foreach ($listaProducto as $key => $value) {
                echo '<div class="row" style="padding:5px 15px">

                  <div class="col-xs-2 ingresoCantidad">

                    <div class="input-group">
                      
                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarDetalle" idProducto><i class="fa fa-times"></i></button></span>

                      <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock nuevoStock required>

                      </select>

                    </div>
                    
                  </div>

                  <div class="col-xs-3" style="padding-right:0px">
                  
                    <div class="input-group col-xs-12">

                      <select class="form-control nuevaDescripcionProducto" name="nuevaDescripcionProducto"   required>

                      <option value="'.$value["codigo"].'">'.$value["codigo"].'-'.$value["descripcion"].'</option>

                      </select>

                    </div>

                  </div>

                  <div class="col-xs-6 ingresoDetalle" style="padding-right:0px">

                    <div class="input-group col-xs-12">
                         
                      <input type="text" class="form-control nuevoDetalleProducto" name="nuevoDetalleProducto" readonly required value="'.$value["descripcion"].'">
         
                    </div>
                     
                  </div>

                </div>';
              }
           ?>    
            
            </div>

            <input type="hidden" id="listaProductos" name="listaProductos">
              
            <div class="box-footer">
              <button type="button" class="btn btn-warning pull-left"><i class="fa fa-print"></i> Imprimir</button>
              <button type="button" class="btn btn-success pull-left"><i class="fa fa-check"></i> Postear</button>

              <button type="submit" class="btn btn-primary pull-right  GuardarLinNR"><i class="fa fa-save"></i> Guardar</button>

            </div>
          </div>

          <?php 
            $EditarNR = new  ControladorNotaRemision();
            $EditarNR -> ctrEditarNotasRemision();

          ?>
        </form>
      </div>

  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->