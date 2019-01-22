<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Proveedores
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Proveedores</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">Agregar Proveedor</button>  
        
      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped tablas">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Placa</th>
              <th>Marca</th>
              <th>Chofer</th>
              <th>Celular chofer</th>
              <th>Estado</th>
              
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

          <?php

            $item = null;
            $valor = null;

            $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

            foreach ($proveedores as $key => $value) {
              $nombre = $value["nombre_com"];
              $chofer = $value["chofer"];
              echo '<tr>
              <td>'.($key+1).'</td>
              <td>'.$nombre.'</td>
              <td>'.$value["celular"].'</td>
              <td>'.$value["placa_camion"].'</td>
              <td>'.$value["marca"].'</td>
              <td>'.$chofer.'</td>
              <td>'.$value["cel_chofer"].'</td>';

              if ($value["habilitado"] != 0) {
                echo '<td><button class="btn btn-success btn-xs btnActivarProvee" idProvee="'.$value["idprovee"].'" estadoProvee="0">Activado</button></td>';
              }else{
                echo '<td><button class="btn btn-danger btn-xs btnActivarProvee" idProvee="'.$value["idprovee"].'" estadoProvee="1">Desactivado</button></td>';
              }

              echo '<td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditarProvee" idProvee="'.$value["idprovee"].'" data-toggle="modal" data-target="#modalEditarProvee"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger btnEliminarProvee" idProvee="'.$value["idprovee"].'" ><i class="fa fa-times"></i></button>
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
=              MODAL AGREGAR PROVEEDORES        =
==============================================-->
<!-- Modal -->
<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role ="form" method="post" enctype="multipart/form-data">
       
        <!--===========================================
        =               Cabeza del MODAL              =
        ============================================-->
        <div class="modal-header" style="background: #3c8dbc; color:  white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar proveedor</h4>
        </div>
        
        <!--===========================================
        =               Cuerpo del MODAL              =
        ============================================-->
        <div class="modal-body">
          <div class="box-body"> 

              <!-- ENTRADA CODIGO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Codigo" required>
                </div>
              </div>
              
              <!-- ENTRADA NOMBRE-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Nombre del dueño" required>
                </div>
              </div>
                                        
              <!-- ENTRADA FONO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoFono" placeholder="Telefono">
                </div>
              </div>

              <!-- ENTRADA PLACA-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevaPlaca" placeholder="Placa camion">
                </div>
              </div>

              <!-- ENTRADA MARCA-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Marca camion">
                </div>
              </div>

              <!-- ENTRADA CHOFER-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoChofer" placeholder="Nombre chofer">
                </div>
              </div>

              <!-- ENTRADA CELULAR-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoCelu" placeholder="Telefono chofer">
                </div>
              </div>


          </div>
        </div>
        
        <!--===========================================
        =                 Pie del MODAL               =
        ============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>

        <?php 

          $crearProveedor = new  ControladorProveedores();
          $crearProveedor -> ctrCrearProveedor();

        ?>
      </form>  
    </div>

  </div>
</div>

<!--=============================================
=              MODAL EDITAR PROVEEDOR           =
==============================================-->
<!-- Modal -->
<div id="modalEditarProvee" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role ="form" method="post" enctype="multipart/form-data">
       
        <!--===========================================
        =               Cabeza del MODAL              =
        ============================================-->
        <div class="modal-header" style="background: #3c8dbc; color:  white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar proveedor</h4>
        </div>
        
        <!--===========================================
        =               Cuerpo del MODAL              =
        ============================================-->
        <div class="modal-body">
          <div class="box-body"> 
              
              <!-- ENTRADA CODIGO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" id="editarCod" name="editarCod"value="" required>
                  <input type="hidden" id="codActual" name="codActual">
                </div>
              </div>

              <!-- ENTRADA NOMBRE-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
                  <input type="hidden" id="nombreActual" name="nombreActual">
                </div>
              </div>
              
              <!-- ENTRADA FONO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="editarFono" name="editarFono" value="">
                  <input type="hidden" id="fonoActual" name="fonoActual">
                </div>
              </div>

              <!-- ENTRADA PLACA-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="editarPlaca" name="editarPlaca" value="">
                  <input type="hidden" id="placaActual" name="placaActual">
                </div>
              </div>

              <!-- ENTRADA MARCA-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="editarMarca" name="editarMarca" value="">
                  <input type="hidden" id="marcaActual" name="marcaActual">
                </div>
              </div>

              <!-- ENTRADA CHOFER-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarChofer" name="editarChofer" value="">
                  <input type="hidden" id="choferActual" name="choferActual">
                </div>
              </div>

              <!-- ENTRADA FONO CHOFER-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="editarFonoChofer" name="editarFonoChofer" value="">
                  <input type="hidden" id="fonoChoferActual" name="fonoChoferActual">
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

          //$crearUsuario = new  ControladorUsuarios();
          //$crearUsuario -> ctrEditarUsuario();

        ?>
      </form>  
    </div>

  </div>
</div>

<?php 
  $borrarProveedor = new ControladorProveedores();
  $borrarProveedor -> ctrBorrarProvee();
?>






