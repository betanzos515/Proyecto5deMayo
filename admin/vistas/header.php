<?php
require "../config/Conexion.php";
$consulta="SELECT * FROM entidad";
$resultado=mysqli_query($conexion, $consulta);
$filae=mysqli_fetch_row($resultado) ;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CONTROL QR</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="../public/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../public/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../public/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="../public/bower_components/galeria/jquery.lighter.css">


<!-- <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico"> -->

    <!-- DATATABLES -->
<link rel="stylesheet" href="../public/bower_components/datatables/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="../public/bower_components/datatables/css/buttons.dataTables.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="../public/bower_components/datatables/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="../public/bower_components/datatables/css/responsive.bootstrap.min.css">

<link rel="stylesheet" href="../public/bower_components/bootstrap-select/bootstrap-select.min.css">
<link rel="stylesheet" href="../public/bower_components/SweeAlert2/sweetalert2.min.css">
<link rel="stylesheet" href="../public/js/style.css">
<link rel="stylesheet" href="../public/css/material-icons.css">


  </head>
  <body class="hold-transition blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>QR</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CONTROL</b> QR</span>
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


        <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <!-- <span class="label label-danger">9</span> -->
            </a>
            <ul class="dropdown-menu">

              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                </ul>
              </li>
              <li class="footer">
                <a href="escritorio.php">INICIO</a>
              </li>
            </ul>
          </li>




              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/ie/<?php echo utf8_decode($filae[3]); ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"> <?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/ie/<?php echo utf8_decode($filae[3]); ?>" class="img-circle" width="50px" alt="User Image">
                    <p>
                      <?php echo $_SESSION['nombre']; ?>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> salir</a>
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
              <div class="user-panel">
                <div class="pull-left image"><img src="../files/ie/<?php echo utf8_decode($filae[3]); ?>" class="img-circle" width="50px" alt="User Image">
        <!--           <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
                </div>
                <div class="pull-left info">
                  <p><?php echo $_SESSION['nombre']; ?></p>
                  <a href="#"><i class="fa fa-circle text-success"></i> Enlinea</a>
                </div>
              </div>
              <!-- search form -->
              <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                <!--    <input type="text" name="q" class="form-control" placeholder="Buscar...">
                  <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                          <i class="fa fa-search"></i>
                        </button>
                      </span>-->
                </div>
              </form>

          <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
            <li>
                  <a href="escritorio.php">
                    <i class="fa fa-pie-chart"></i>
                    <span>INICIO</span>
                    <span class="label label-primary label-circle pull-right"></span>
                  </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-user-plus"></i> <span>PERSONAL</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li><a href="persona.php"><i class="fa fa-circle-o"></i>Estudiante</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i> <span>CONFIGURACION</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a  href="entidad.php "><i class="fa fa-circle-o"></i>Institucion</a></li>
                <li><a href="config_ass.php"><i class="fa fa-circle-o"></i>Asistencias</a></li>

              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>REPORTES</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li><a href="rptworking.php "><i class="fa fa-circle-o"></i>Asistencias</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-unlock-alt"></i> <span>ACCESO</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li><a href="usuario.php"><i class="fa fa-circle-o"></i>Usuarios</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="../../" target="_black">
                <i class="fa fa-unlink"></i>
                <span> CONTROL QR</span>
              </a>
            </li>
         </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
