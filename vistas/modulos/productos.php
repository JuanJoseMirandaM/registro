<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Productos
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Productos</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">Agregar Producto</button>  
        
      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped tablas dt-responsive">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th style="width:10px">Codigo</th>
              <th>Descripcion</th>
              <th>Peso</th>
              <th>Bot X Caja</th>
              <th>Litros X Bot</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

          <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorProductos::ctrMostrarProductos($item, $valor);

            foreach ($usuarios as $key => $value) {
              echo '<tr>
              <td>'.($key+1).'</td>
              <td>'.$value["cod_producto"].'</td>
              <td>'.$value["descripcion_largo"].'</td>
              <td>'.$value["peso"].' qq </td>
              <td>'.$value["bot_x_caja"].' unid</td>
              <td>'.$value["litro_x_bot"].' lts</td>';

              if ($value["habilitado"] != 0) {
                echo '<td><button class="btn btn-success btn-xs btnActivarProducto" idProducto="'.$value["cod_producto"].'" estadoProducto="0">Activado</button></td>';
              }else{
                echo '<td><button class="btn btn-danger btn-xs btnActivarProducto" idProducto="'.$value["cod_producto"].'" estadoProducto="1">Desactivado</button></td>';
              }

              echo '<td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditarProducto" idProducto="'.$value["cod_producto"].'" data-toggle="modal" data-target=#modalEditarProducto><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger btnEliminarProducto" idProducto="'.$value["cod_producto"].'"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>';
            }

          ?>  
            

          </tbody>
        </table>
      </div>

      <!-- /.box-body --
      <div class="box-footer">
        Footer
      </div>
    -- /.box-footer-->
    </div>
  <!-- /.box -->
  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--=============================================
=              MODAL AGREGAR PRODUCTO           =
==============================================-->
<!-- Modal -->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role ="form" method="post" enctype="multipart/form-data">
       
        <!--===========================================
        =               Cabeza del MODAL              =
        ============================================-->
        <div class="modal-header" style="background: #3c8dbc; color:  white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar producto</h4>
        </div>
        
        <!--===========================================
        =               Cuerpo del MODAL              =
        ============================================-->
        <div class="modal-body">
          <div class="box-body"> 

              <!-- ENTRADA Codigo-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" id="nuevoCodigo" required>
                </div>
              </div>
              
              <!-- ENTRADA DESCRIPCION-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripcion" required>
                </div>
              </div>
              
              <!-- ENTRADA PESO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoPeso" placeholder="Ingresar Peso" required>
                </div>
              </div>
              
              <!-- botellas por caja-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoBXC" placeholder="Ingresar numero de botellas por caja">
                </div>
              </div>

              <!-- Litros por botella-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoLXB" placeholder="Ingresar litros por botella">
                </div>
              </div>

          </div>
        </div>
        
        <!--===========================================
        =                 Pie del MODAL               =
        ============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>

        <?php 

          $crearProducto = new  ControladorProductos();
          $crearProducto -> ctrCrearProducto();

        ?>
      </form>  
    </div>

  </div>
</div>

<!--=============================================
=              MODAL EDITAR PRODUCTO            =
==============================================-->
<!-- Modal -->
<div id="modalEditarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role ="form" method="post" enctype="multipart/form-data">
       
        <!--===========================================
        =               Cabeza del MODAL              =
        ============================================-->
        <div class="modal-header" style="background: #3c8dbc; color:  white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar producto</h4>
        </div>
        
        <!--===========================================
        =               Cuerpo del MODAL              =
        ============================================-->
        <div class="modal-body">
          <div class="box-body"> 
              
              <!-- ENTRADA CODIGO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo"value="" required>
                  <input type="hidden" id="codigoActual" name="codigoActual">
                </div>
              </div>

              <!-- ENTRADA DESCRIPCION-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" value="" required>
                  <input type="hidden" id="descripcionActual" name="descripcionActual">
                </div>
              </div>
              
              <!-- ENTRADA PESO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarPeso" name="editarPeso" value="" required>
                  <input type="hidden" id="pesoActual" name="pesoActual">
                </div>
              </div>
              
              <!-- ENTRADA botellas x caja-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarBXC" name="editarBXC" value="" required>
                  <input type="hidden" id="BXCActual" name="BXCActual">
                </div>
              </div>

              <!-- ENTRADA litros por botella-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarLXB" name="editarLXB" value="" required>
                  <input type="hidden" id="LXBActual" name="LXBActual">
                </div>
              </div>

          </div>
        </div>
        
        <!--===========================================
        =                 Pie del MODAL               =
        ============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>

        <?php 

          $crearProducto = new  ControladorProductos();
          $crearProducto -> ctrEditarProducto();

        ?>
      </form>  
    </div>

  </div>
</div>

<?php 
  $borrarProducto = new ControladorProductos();
  $borrarProducto -> ctrBorrarProducto();
?>






