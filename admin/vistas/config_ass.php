<?php

ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}

require 'header.php';

?>

      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">LISTA DE ASISTENCIAS </h4>


                      <div class="box-tools pull-right">
                      </div>
                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th><input type="checkbox" id="checkall" > <a href="#" id="delsel" onclick="eliminarsel()"><i class="glyphicon glyphicon-trash" style="color: red;" data-toggle="tooltip" title="Eliminar"></i></a> </th>
                             <th>#</th>
                            <th>Apellidos</th>
                            <th>Nombre</th>
                            <th>Grado</th>
                            <th>Grupo</th>
                            <th>Turno</th> 
                            <th>Fecha</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>

                          </tfoot>
                        </table>
                        </div>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px">

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" class="form-control" name="idassistance" id="idassistance" maxlength="100" required>
                             <input type="hidden" class="form-control" name="idpeople" id="idpeople" maxlength="100" required>
                             <label>Nombres</label>
                             <input type="text" class="form-control" disabled name="nombre" id="nombre" maxlength="100" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellidos</label>
                             <input type="text" class="form-control" disabled name="apellidos" id="apellidos" maxlength="100" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Hora Entrada</label>
                            <input type="hidden" class="form-control" name="fecha" id="fecha" maxlength="100" required>
                             <input type="text" class="form-control" name="h_entrada" id="h_entrada" maxlength="100" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Hora Salida</label>
                             <input type="text" class="form-control" name="h_salida" id="h_salida" maxlength="100" >
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
// }
// else
// {
//   require 'noacceso.php';
// }
require 'footer.php';
?>
<script type="text/javascript" src="scripts/config_ass.js"></script>


<script>
  $(document).ready(function(){

});
</script>


<?php


// }
ob_end_flush();
?>
