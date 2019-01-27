  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        
        <li class="active">
          <a href="inicio">
            <i class="fa fa-home"></i> <span>Inicio</span>
          </a>
        </li>
        
        <?php 
          //<!--Usuarios-->
          if ($_SESSION["perfil"] == "admin") {
            echo '<li>
              <a href="usuarios">
                <i class="fa fa-user"></i> <span>Usuarios</span>
              </a>
            </li>';
          }

          if ($_SESSION["perfil"] == "admin" || $_SESSION["perfil"] == "Administrador") {
            //<!--Productos-->
            echo '<li>
              <a href="productos">
                <i class="fa fa-cubes"></i> <span>Productos</span>
              </a>
            </li>';
          }

          if ($_SESSION["perfil"] == "admin" || $_SESSION["perfil"] == "Administrador") {
            //<!--Notas de Remision-->
            echo '<li>
              <a href="proveedores">
                <i class="fa fa-group"></i> <span>Proveedores</span>
              </a>
            </li>';
          }
         ?>
        
       <!-- <li>
          <a href="notaremision">
            <i class="fa fa-pencil"></i> <span>Notas de Remision</span>
          </a>
        </li>-->
      
        <li class="treeview">

        <a href="#">

          <i class="fa fa-list-ul"></i>
          
          <span>Notas de Remision</span>
          
          <span class="pull-right-container">
          
            <i class="fa fa-angle-left pull-right"></i>

          </span>

        </a>

        <ul class="treeview-menu">
          
          <li>

            <a href="notaremision">
              
              <i class="fa fa-circle-o"></i>
              <span>Admi nota remision</span>

            </a>

          </li>

          <li>

            <a href="crear-notaremision">
              
              <i class="fa fa-circle-o"></i>
              <span>Crear nota remision</span>

            </a>

          </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>