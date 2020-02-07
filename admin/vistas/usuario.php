<?php

ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">LISTA DE USUARIO </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-block "  style="border: 1px #D8D8D8 solid; border-radius: 5px; padding-top:5px;padding-bottom: 5px; margin-bottom: 6px;">

                      <button class="btn btn-primary pull-right" id="btnagregar" onclick="mostrarform(true)"><i class=" fa  fa-user-plus"></i> Agregar Nuevo</button>
                      </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Login</th>
                            <th>Condicion</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="iduser" id="iduser">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Login (*):</label>
                            <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Login" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Clave (*) - Es necesario editar cada vez que actualize:</label>
                            <input type="password" data-toggle="tooltip" data-placement="top" title="Advertencia es necesario que modifique la contraseña si actualiza cualquier dato del usuario" class="form-control" name="clave" id="clave" maxlength="64" placeholder="Clave" required>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php

require 'footer.php';
?>

<script type="text/javascript" src="scripts/usuario.js"></script>
 <?php
 }
ob_end_flush();
 ?>
