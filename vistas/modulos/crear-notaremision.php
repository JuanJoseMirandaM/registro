<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Notas de Remision
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="notaremision"><i class="fa fa-dashboard"></i>Notas de Remision</a></li>
      <li class="active">Crear Notas de Remision</li>
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
                    <input type="text" class="form-control  nuevoUsuario" id="nuevoUsuario" name="nuevoUsuario" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                    <input type="hidden" class="nuevoIdU" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">    
                  </div>
                </div>

              </div>

              <div class="form-group row ">
                    
                <div class="col-lg-2 col-sm-2 col-xs-6" style="padding-right: 0px">
                    
                  <div class="input-group col-lg-12 col-sm-12 col-xs-12">
                        
                    <label>Tipo</label>
                    <select name="nuevoTipo" id="nuevoTipo" class="form-control  nuevoTipo" style="width: 100%;" required>
                      <option value="NR">Nota Remision</option>
                    </select>

                  </div>

                  <label>Fecha</label>

                  <div class="input-group date col-lg-12 col-sm-12 col-xs-12">
                    <input type="text" class="datepicker form-control pull-rigft nuevaFecha" id="nuevaFecha" name="nuevaFecha">
                  </div>
                      
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-6" style="padding-right: 0px">
                    
                  <div class="input-group">
                        
                    <label>Numero</label>
                    <?php

                    $item = null;
                    $valor = null;
                    $orden = true;

                    $ventas = ControladorNotaRemision::ctrMostrarNotasRemision($item, $valor, $orden);
                    
                    if(!$ventas){

                      echo '<input type="number" class="form-control nuevoNumero" id="nuevoNumero" name="nuevoNumero" value="1001" required readonly>';
                      echo '<input type="hidden" class="form-control nuevoIdNR" id="nuevoIdNR" name="nuevoIdNR" value="1">';

                    }else{

                      foreach ($ventas as $key => $value) {    

                      }
                      $numero = $value["numero"] + 1;
                      $codigo = $value["automatico"] + 1;
                      $idNR = $value["idNR"] + 1;

                      echo '<input type="number" class="form-control nuevoNumero" id="nuevoNumero" name="nuevoNumero" value="'.$numero.'" required readonly>';

                      echo '<input type="hidden" class="form-control nuevoCodigo" id="nuevoCodigo" name="nuevoCodigo" value="'.$codigo.'">';
                  
                      echo '<input type="hidden" class="form-control nuevoIdNR" id="nuevoIdNR" name="nuevoIdNR" value="'.$idNR.'">';
                    }

                    ?>
                    
                        
                  </div>

                  <div class="input-group">
                        
                    <label>Numero NR</label>
                    <input type="number" class="form-control nuevoNR" id="nuevoNR" name="nuevoNR"  placeholder="Numero NR" required>

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
                    <input type="number" class="form-control nuevoDC" id="nuevoDC" name="nuevoDC"  placeholder="Numero DC" value="0" required>
                  </div>

                </div>

                <div class="col-lg-2 col-sm-2 col-xs-6" style="padding-right: 0px">
                  <div class="input-group">
                        
                    <label>T/C</label>
                        
                    <input type="text" class="form-control nuevoTC" id="nuevoTC" name="nuevoTC"  value="6.96" required readonly>

                  </div> 

                  <div class="input-group">
                        
                    <label>Numero SAP</label>
                        
                    <input type="number" class="form-control nuevoSAP" id="nuevoSAP" name="nuevoSAP"  placeholder="Numero SAP" required>

                  </div>   

                </div>

              </div>

              <div class="form-group row">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Flete de</label>
                <div class="col-lg-2 col-sm-2 col-xs-8">
                  <select name="nuevaFlete" id="nuevaFlete" class="form-control  nuevaFlete" style="width: 100%;" required>
                    <option value="IDA">Ida</option>
                    <option value="RETORNO">Retorno</option>
                    <option value="DE IDA Y VUELTA">Ida y vuelta</option>
                  </select>
                </div>
                <label class="col-lg-1 col-sm-1 col-xs-2 col-form-label">Origen</label>
                <div class="col-lg-2 col-sm-3 col-xs-4">
                  <select name="nuevoOrigen" id="nuevoOrigen" class="form-control  nuevoOrigen" style="width: 100%;" required>
                    <option value="LPZ" selected>La Paz</option>
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
                    <option value="LPZ">La Paz</option>
                    <option value="ORU" selected>Oruro</option>
                    <option value="CBB">Cochabamba</option>
                    <option value="SCZ">Santa Cruz</option>
                    <option value="POT">Potosi</option>
                    <option value="SUC">Sucre</option>
                    <option value="TAR">Tarija</option>
                  </select>
                </div>
              </div>

              <div class="form-group row ">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Transporte</label>
                <div class="col-lg-2 col-sm-4 col-xs-8">
                  <select name="nuevaPlaca" id="nuevaPlaca" class="form-control  nuevaPlaca select2" style="width: 100%;" required>
                    <option value="">Seleccione Placa</option>
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
                  <input type="text" class="form-control nuevoDueno" id="nuevoDueno" name="nuevoDueno"  placeholder="Dueño" readonly required>
                  <input type="hidden" class="nuevoCodCamion" id="nuevoCodCamion" name="nuevoCodCamion" value="">
                  <input type="hidden" class="nuevaPlacaCamion" id="nuevaPlacaCamion" name="nuevaPlacaCamion" value="">
                </div>

              </div>

              <div class="form-group row">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Conductor</label>
                <div class="col-lg-6 col-sm-10 col-xs-8">
                  <input type="text" class="form-control nuevoChofer" id="nuevoChofer" name="nuevoChofer"  placeholder="Chofer" required>
                </div>
              </div>
              
              <div class="form-group row">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Glosa</label>
                <div class="col-lg-6 col-sm-10 col-xs-8">
                  <textarea class="form-control" rows="3" id="nuevaGLosa" name="nuevaGlosa" value=" " ></textarea>
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
            <div class="row" style="padding:5px 15px">

              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 ingresoCantidad">

                <div class="form-group">
                  
                  <label>Cantidad</label>

                </div>
                    
              </div>

              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6" style="padding-right:0px">
                  
                <div class="form-group">
                  
                  <label>Codigo</label>

                </div>

              </div>

              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-10 ingresoDetalle" style="padding-right:0px">

                <div class="form-group">
                  
                  <label>Detalle</label>

                </div>
                     
              </div>

            </div>
            <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
            ======================================--> 

            <div class="form-group row nuevoProducto">

                

            </div>

            <input type="hidden" id="listaProductos" name="listaProductos">
              
            <div class="box-footer">
              <!--<button type="button" class="btn btn-warning pull-left"><i class="fa fa-print"></i> Imprimir</button>
              <button type="button" class="btn btn-success pull-left"><i class="fa fa-check"></i> Postear</button>
              -->
              <button type="submit" class="btn btn-primary pull-right  GuardarLinNR"><i class="fa fa-save"></i> Guardar</button>

            </div>
          </div>

          <?php 
            
            $item = null;
            $valor = null;

            //$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
            //var_dump($respuesta);
            $CrearNR = new  ControladorNotaRemision();
            $CrearNR -> ctrCrearNotasRemision();

          ?>
        </form>
      </div>

  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->