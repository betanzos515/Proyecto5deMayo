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

date_default_timezone_set('America/Lima');
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border" style="color: #fff; background-color:#1755c6">
                          <h1 class="box-title">REPORTES DE ASISTENCIAS </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-block "  style="border: 1px #D8D8D8 solid; border-radius: 5px; padding-top:5px;padding-bottom: 1px; margin-bottom: 6px;">
                        <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                          <label>Fecha Inicio</label>
                          <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                          <label>Fecha Fin</label>
                          <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                        </div>

                      <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                          <label>Marcar Hora Entrada </label>
                                <input type="time" autofocus="autofocus" data-toggle="tooltip" data-placement="bottom" title="Marque la hora de entrada en formato de 24 Horas para obtener las tardanzas" class="form-control" name="diferencia" id="diferencia" placeholder="Digite DNI" required="">
                        </div>
                    </div>

                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-block "  style="border: 1px #D8D8D8 solid; border-radius: 5px; padding-top:5px;padding-bottom: 5px; margin-bottom: 3px;">

                        <div class="form-inline col-lg-3 col-md-4 col-sm-4 col-xs-12">
                          <label>Turno</label>
                          <select name="nivel" id="nivel" class="form-control selectpicker"  required >
                            <option value="">Seleccionar Turno</option>
                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                          </select>
                        </div>

                        <div id="divp" class="form-inline col-lg-3 col-md-4 col-sm-4 col-xs-12">
                          <label>Grado</label>
                          <select name="grado" id="grado" class="form-control selectpicker"  required >
                            <option value="">Seleccionar</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>


                          </select>
                        </div>

                        <div id="divsc" class="form-inline col-lg-3 col-md-4 col-sm-4 col-xs-12">
                          <label>Grupo</label>
                          <select name="seccion" id="seccion" class="form-control selectpicker"  required >
                            <option value="">Seleccionar</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>

                          </select>
                        </div>
                    </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-block "  style="border: 1px #D8D8D8 solid; border-radius: 5px; padding-top:5px;padding-bottom: 6px; margin-bottom: 7px;">
                       <button class="btn btn-primary pull-left" id="btnprint" onclick="rpt()" name="rpt"><i class="glyphicon glyphicon-print"></i> IMPRIMIR</button>
                    </div>

                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                         <thead style="color: #fff; background-color:#1755c6">
                            <th>#</th>
                            <th>Turno</th>
                            <th>Apellidos</th>
                            <th>Nombre</th>
                            <th>Grado</th>
                            <th>Grupo</th>
                            <th>Fecha</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th data-toggle="tooltip" data-placement="top" title=" los que tienen el simbolo (-) representa las tardanzas">Diferencia</th>

                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                        </div>
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
<script type="text/javascript" src="scripts/working.js"></script>
 <?php
 }
ob_end_flush();
 ?>


<script type="text/javascript">

$(document).ready(function(){

             $("#nivel").val("");
             $("#nivel").selectpicker('refresh');

             $("#divp").css("display", "none");
             $("#divsc").css("display", "none");
             $("#opp").show();


  $("#nivel").change(function () {
        $("#nivel option:selected").each(function () {
          seleccion=$(this).val();

           if (seleccion=="Matutino") {
             $("#divp").css("display", "block");
             $("#divsc").css("display", "block");

            $("#grado").val("");
            $("#grado").selectpicker('refresh');
            $("#seccion").val("");
            $("#seccion").selectpicker('refresh');
            $("#opp").hide();

          }else if(seleccion=="Vespertino"){
            $("#divp").css("display", "block");
            $("#divsc").css("display", "block");

            $("#grado").val("");
            $("#grado").selectpicker('refresh');
            $("#seccion").val("");
            $("#seccion").selectpicker('refresh');
            $("#opp").show();
          }else{
             $("#divp").css("display", "none");
             $("#divsc").css("display", "none");

             $("#grado").val("");
             $("#grado").selectpicker('refresh');
             $("#seccion").val("");
            $("#seccion").selectpicker('refresh');
            $("#opp").show();
          }

        });
    })
});


</script>
