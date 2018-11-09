<?php
require_once('../models/Categorias.php');
require_once('../models/Articulo.php');
require_once('../models/usuario.php');
$categorias = new Categorias();
$articulo = new Articulo();
$usuario = new Usuario();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Caridad Y Santa, C.A.</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/_all-skins.min.css">



    <link rel="stylesheet" href="css/sweetalert2.css" type="text/css">
    <link rel="stylesheet" href="css/sweetalert2.min.css" type="text/css">
    <script type="text/javascript" src="js/sweetalert2.js"></script>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="./Home.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>CY</b>S</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CaridadYSanta</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">Juan Carlos Arcila Díaz</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                      www.incanatoit.com - Desarrollando Software
                      <small>www.youtube.com/jcarlosad7</small>
                    </p>
                  </li>  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="./Home.php?module=categorias&funcion=tabla_categorias"><i class="fa fa-circle-o"></i> Categorías</a></li>
                <li><a href="./Home.php?module=articulos&funcion=tabla_articulos"><i class="fa fa-circle-o"></i> Artículos</a></li>
              </ul>
            </li> 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="./Home.php?module=compras&funcion=ingreso_compras"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="./Home.php?module=compras&funcion=tabla_compras"><i class="fa fa-circle-o"></i> Compras</a></li>
                <li><a href="./Home.php?module=compras&funcion=tabla_proveedor"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="./Home.php?module=ventas&funcion=crear_venta"><i class="fa fa-circle-o"></i> Ingresos </a></li>
                <li><a href="./Home.php?module=ventas&funcion=tabla_ventas"><i class="fa fa-circle-o"></i> Ventas </a></li>
                <li><a href="./Home.php?module=ventas&funcion=tabla_clientes"><i class="fa fa-circle-o"></i> Clientes </a></li>
              </ul>
            </li>           
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Parametros</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="./Home.php?module=usuario&funcion=tabla_usuario"><i class="fa fa-circle-o"></i> Impuestos</a></li>
                <li><a href="./Home.php?module=usuario&funcion=tabla_usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="./Home.php?module=usuario&funcion=tabla_usuario"><i class="fa fa-circle-o"></i> Roles</a></li>
                
              </ul>
            </li>
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>       
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
	                  <div class="col-md-12">
		                <!--Contenido-->
                    <?php
                    switch (@$_GET['module']) {
                      
                      case 'categorias':
                        
                        require_once('./module/categorias/Route.php');

                        break;

                      case 'articulos':
                        
                        require_once('./module/articulos/Route.php');

                        break;

                      case 'usuario':
                        
                          require_once('./module/usuario/Route.php');
                        
                        break;

                      case 'compras':
                          
                          require_once('./module/compras/Route.php');

                        break;

                      case 'ventas':
                          
                          require_once('./module/ventas/Route.php');

                        break;
                      
                      default:
                        # code...
                        break;
                    }


                    ?>
		                <!--Fin Contenido-->
                    </div>
                  </div>      
                </div>
              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->

      </div><!-- /.row -->
      </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
          <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Teléfono:</b>0212-443-8-43
            </div>
            <strong>Copyright &copy; 2010-2020.</strong> Todos los derechos reservados.
          </footer>
    <!-- jQuery 2.1.4 -->
    <script src="js/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/app.min.js"></script> 
  </body>

</html>
