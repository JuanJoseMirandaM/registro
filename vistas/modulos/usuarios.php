<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Usuarios
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Usuarios</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Usuario</button>  
        
      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped tablas dt-responsive">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>ci</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Telefono</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

          <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $value) {
              echo '<tr>
              <td>'.($key+1).'</td>
              <td>'.$value["ci"].'</td>
              <td>'.$value["nombre"].'</td>
              <td>'.$value["usuario"].'</td>';

              if($value["foto"] == ""){
                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" alt="img-thumbnail" width="40px"></td>';
              }else{
                echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" alt="img-thumbnail" width="40px"></td>';
              }
              

              echo '<td>'.$value["fono"].'</td>
              <td>'.$value["perfil"].'</td>';

              if ($value["estado"] != 0) {
                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["idUsuario"].'" estadoUsuario="0">Activado</button></td>';
              }else{
                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["idUsuario"].'" estadoUsuario="1">Desactivado</button></td>';
              }

              echo '<td>'.$value["ultimo_login"].'</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["idUsuario"].'" data-toggle="modal" data-target=#modalEditarUsuario><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["idUsuario"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'" ><i class="fa fa-times"></i></button>
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
=              MODAL AGREGAR USUARIOS           =
==============================================-->
<!-- Modal -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role ="form" method="post" enctype="multipart/form-data">
       
        <!--===========================================
        =               Cabeza del MODAL              =
        ============================================-->
        <div class="modal-header" style="background: #3c8dbc; color:  white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar usuario</h4>
        </div>
        
        <!--===========================================
        =               Cuerpo del MODAL              =
        ============================================-->
        <div class="modal-body">
          <div class="box-body"> 

              <!-- ENTRADA CI-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoCi" placeholder="Ingresar CI" required>
                </div>
              </div>
              
              <!-- ENTRADA NOMBRE-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
                </div>
              </div>
              
              <!-- ENTRADA USUARIO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>
                </div>
              </div>
              
              <!-- ENTRADA CONTRASENA-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
                </div>
              </div>
              
              <!-- ENTRADA FONO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoFono" placeholder="Ingresar telefono">
                </div>
              </div>

              <!-- ENTRADA PERFIL-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select name="nuevoPerfil" class="form-control input-lg">
                    <option value="">Seleccionar perfil</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Contador">Usuario</option>
                  </select>
                </div>
              </div>

              <!-- ENTRADA PARA SUBIR FOTO-->
              <div class=" form-group">
                <div class="panel ">SUBIR FOTO</div>
                <input type="file" class="nuevaFoto" name="nuevaFoto">
                <p class="help-block">Peso maximo de la foto 2 MB</p>
                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
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

          $crearUsuario = new  ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();

        ?>
      </form>  
    </div>

  </div>
</div>

<!--=============================================
=              MODAL EDITAR USUARIOS           =
==============================================-->
<!-- Modal -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role ="form" method="post" enctype="multipart/form-data">
       
        <!--===========================================
        =               Cabeza del MODAL              =
        ============================================-->
        <div class="modal-header" style="background: #3c8dbc; color:  white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>
        
        <!--===========================================
        =               Cuerpo del MODAL              =
        ============================================-->
        <div class="modal-body">
          <div class="box-body"> 
              
              <!-- ENTRADA CI-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarCi" name="editarCi"value="" required>
                  <input type="hidden" id="ciActual" name="ciActual">
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
              
              <!-- ENTRADA USUARIO-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
                  
                </div>
              </div>
              
              <!-- ENTRADA CONTRASENA-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña" >
                  <input type="hidden" id="passwordActual" name="passwordActual">
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

              <!-- ENTRADA PERFIL-->
              <div class=" form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select name="editarPerfil" class="form-control input-lg">
                    <option value="" id="editarPerfil"></option>
                    <option value="Administrador">Administrador</option>
                    <option value="Contador">Usuario</option>
                  </select>
                </div>
              </div>

              <!-- ENTRADA PARA SUBIR FOTO-->
              <div class=" form-group">
                <div class="panel ">SUBIR FOTO</div>
                <input type="file" class="nuevaFoto" name="editarFoto">
                <p class="help-block">Peso maximo de la foto 2 MB</p>
                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                <input type="hidden" id="fotoActual" name="fotoActual">
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

          $crearUsuario = new  ControladorUsuarios();
          $crearUsuario -> ctrEditarUsuario();

        ?>
      </form>  
    </div>

  </div>
</div>

<?php 
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();
?>






