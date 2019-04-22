<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Notas de Remision
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="notaremision"><i class="fa fa-dashboard"></i>Notas de Remision</a></li>
      <li class="active">Confirmar Nota de Remision</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!--=====================================
      =              Formulario               =
      ======================================-->
      <form action="" role="form" method="post" class="formularioNR">
        <!--=======================================
        =                 CABECERA                =
        ========================================-->
        <div class="col-lg-12">
          <div class="box box-primary">

            <div class="box-header with-border"></div>

            <div class="box-body">
              <?php

                $item  = "idNR";
                $valor = $_GET['idNR'];
                $orden = true;

                $NR = ControladorNotaRemision::ctrMostrarNotasRemision($item, $valor, $orden);

              ?>
              <div class="form-group row ">

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Tipo</label>
                  <input type="text" class="form-control nuevoTipo" id="nuevoTipo" name="nuevoTipo" required readonly value="<?php echo $NR["tipo2"]; ?>">
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Numero</label>
                  <input type="text" class="form-control nuevoNumero" id="nuevoNumero" name="nuevoNumero" required readonly value="<?php echo $NR["automatico"]; ?>">
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Moneda</label>
                  <input type="text" class="form-control nuevaMoneda" id="nuevaMoneda" name="nuevaMoneda" required readonly value="<?php echo $NR["moneda"]; ?>">
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>T/C</label>
                  <input type="text" class="form-control nuevoTC" id="nuevoTC" name="nuevoTC"  value="6.96" required readonly>
                </div>

              </div>

              <div class="form-group row ">

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Fecha</label>
                  <input type="text" class="form-control pull-rigft" id="nuevaFech" name="nuevaFech"  value="<?php echo $NR["fecha"]; ?>" readonly>
                </div>

                <div class="col-lg-2 col-sm-4 col-xs-4">
                  <label>Numero NR</label>
                  <input type="text" class="form-control nuevoNR" id="nuevoNR" name="nuevoNR" required value="<?php echo $NR["numeroNR"]; ?>" readonly>
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Numero DC</label>
                  <input type="text" class="form-control nuevoDC" id="nuevoDC" name="nuevoDC" required value="<?php echo $NR["numeroDC"]; ?>" readonly>
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Numero SAP</label>
                  <input type="text" class="form-control nuevoSAP" id="nuevoSAP" name="nuevoSAP" required value="<?php echo $NR["numeroSAP"]; ?>" readonly>
                </div>

              </div>

              <div class="form-group row ">

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Flete de</label>
                  <input type="text" class="form-control nuevaFlete" id="nuevaFlete" name="nuevaFlete" value="<?php echo $NR["tipo1"]; ?>" readonly>
                </div>

                <div class="col-lg-2 col-sm-4 col-xs-4">
                  <label>Ruta</label>
                  <input type="text" class="form-control nuevaFlete" id="nuevaFlete" name="nuevaFlete" value="<?php echo $NR["origen"]; ?> - <?php echo $NR["destino"]; ?>" readonly>
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Placa</label>
                  <input type="text" class="form-control nuevaPlaca" id="nuevaPlaca" name="nuevaPlaca" required value="<?php echo $NR["placa"]; ?>" readonly>
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-4">
                  <label>Conductor</label>
                  <input type="text" class="form-control nuevoChofer" id="nuevoChofer" name="nuevoChofer" required value="<?php echo $NR["chofer"]; ?>" readonly>
                </div>

              </div>
            
              <div class="form-group row">
                <label class="col-lg-1 col-sm-2 col-xs-4 col-form-label">Glosa</label>
                <div class="col-lg-7 col-sm-10 col-xs-8">
                  <input type="text" class="form-control nuevoGlosa" id="nuevoGlosa" name="nuevoGlosa" required value="<?php echo $NR["glosa1"]; ?>" readonly>
                  

                </div>

              </div>
            </div>
          </div>
        </div>
        
        <!--=======================================
        =             CUENTAS X COBRAR            =
        ========================================-->
        <div class="col-lg-6 col-xs-12">
        
          <div class="box box-success">
              
            <div class="box-header with-border"></div>

            <div class="box-body">
      
              <!--=====================================
              ENTRADA MÉTODO DE COBRO
              ======================================-->

              <div class="form-group row">
                <label class="col-xs-6 col-form-label">Tipo de Cobro</label> 
                <div class="col-xs-6" style="padding-right:0px">
                     
                  <div class="input-group">
                     
                    <select class="form-control" id="nuevoMetodoCobro" name="nuevoMetodoCobro" required>
                      <option value="">Seleccione método de cobro</option>
                      <option value="QQ">Monto x QQ</option>
                      <option value="AF">Aforado</option>
                  
                    </select>    

                  </div>
  
                </div>
              </div>

              <div class="form-group row cobro">

                <div class="cajaMetodoCobro" style="padding-right:0px"></div>

              </div>

              <br>

            </div>

          </div>
            
        </div>
        <!--=======================================
        =             CUENTAS X PAGAR             =
        ========================================-->
        <div class="col-lg-6 col-xs-12">
        
          <div class="box box-danger">
              
            <div class="box-header with-border"></div>

            <div class="box-body">
      
              <!--=====================================
              ENTRADA MÉTODO DE COBRO
              ======================================-->

              <div class="form-group row">
                <label class="col-xs-6 col-form-label">Tipo de Pago</label> 
                <div class="col-xs-6" style="padding-right:0px">
                     
                  <div class="input-group">
                     
                    <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                      <option value="">Seleccione método de cobro</option>
                      <option value="QQ">Monto x QQ</option>
                      <option value="AF">Aforado</option>
                  
                    </select>    

                  </div>
  
                </div>
              </div>

              <div class="form-group row pago">

                <div class="cajaMetodoPago" style="padding-right:0px"></div>

              </div>

              <br>

            </div>

          </div>
            
        </div>
        <!--=======================================
        =                 DETALLE                 =
        ========================================-->
        <div class="col-lg-12">
          <div class="box box-warning">

            <!--=======================================
              =             CABECERA DETALLE            =
              ========================================-->

            <div class="row" style="padding:5px 15px">
              <div class="box-body">
                <table id="confTable" class="table  table-bordered table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th style="width:10%">Cantidad</th>
                      <th style="width:12%">Codigo</th>
                      <th style="width:10%">Peso</th>
                      <th style="width:10%">QQ</th>
                      <th style="width:10%">Precio</th>
                      <th style="width:10%">Flete</th>
                      <th style="width:10%">CxC Bs</th>
                      <th style="width:10%">CxP Bs</th>
                      <th style="width:18%">Glosa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sumPeso = 0;
                    $listaProducto = json_decode($NR["detalle"], true);
                    foreach ($listaProducto as $key => $value) {
                      $item = "cod_producto";
                      $valor = $value["codigo"];

                      $producto = ControladorProductos::ctrMostrarProductos($item, $valor);
                      
                      $sumPeso += $producto["peso"];
                      echo '<tr>
                        <td>'. $value["cantidad"].'</td>
                        <td>'. $value["codigo"] .'</td>
                        <td>'. $producto["peso"].'</td>
                        <td>QQ</td>
                        <td>Precio</td>
                        <td>Flete</td>
                        <td>CxC Bs</td>
                        <td>CxP Bs</td>
                        <td>Glosa</td>
                      </tr>';
                    }
                    echo '</tbody>
                  <tfoot>
                    <tr>
                      <th>Position</th>
                      <th>Office</th>
                      <th>'.$sumPeso.'</th>
                      <th>Start date</th>
                      <th>Salary</th>
                      <th>Flete</th>
                      <th>CxC Bs</th>
                      <th>CxP Bs</th>
                      <th>Glosa</th>
                    </tr>
                </tfoot>';
                    
                    ?>
                  
                </table>
              </div>
            </div>
            <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
            ======================================-->

            <input type="hidden" id="listaProductos" name="listaProductos" value='<?php echo $NR["detalle"]; ?>' >

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right GuardarLinNR"><i class="fa fa-save"></i> Guardar</button>

            </div>
          </div>
        </div>
        <?php
        //$ConfNR = new ControladorNotaRemision();
        //$ConfNR->ctrEditarNotasRemision();
        ?>

      </form>

    </div>
  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


