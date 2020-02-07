<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
  {
require 'header.php';
?>


<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div  class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                      <div class="row">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                          <h6 class="box-title">LISTA DE ESTUDIANTES</h6>
                        </div>

                      </div>

                      <div class="box-tools pull-right">
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->

                    <div class="panel-body table-responsive" id="listadoregistros" >
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-block "  style="border: 1px #D8D8D8 solid; border-radius: 5px; padding-top:5px;padding-bottom: 6px; margin-bottom: 7px;">
                       <button class="btn btn-default " data-toggle="modal" data-target="#modal-default"><i class="glyphicon glyphicon-export"></i> IMPORTAR ESTUDIANTES</button>
                       <button class="btn btn-default " data-toggle="modal" data-target="#modal-qr"><i class="glyphicon glyphicon-print"></i> GENERAR CREDENCIAL</button>
                       <button class="btn btn-primary pull-right " id="btnagregar" onclick="mostrarform(true)"><i class=" fa  fa-user-plus"></i>AGREGAR NUEVO</button>
                    </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th><input type="checkbox" id="checkall"> <a href="#" id="delsel" onclick="eliminarsel()"><i class="glyphicon glyphicon-trash" style="color: red;" data-toggle="tooltip" title="Eliminar"></i></a>  </th>
                            <th>Apellidos</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Grado</th>
                            <th>Grupo</th>
                            <th>Turno</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                    </div>
                  </div>
                    <div class="panel-body" id="formularioregistros" >
                        <form name="formulario" id="formulario" method="POST" >

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px">

                          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellidos:</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" maxlength="100" placeholder="Digite apellidos"
                             required>
                          </div>

                          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                             <input type="hidden" class="form-control" name="idpeople" id="idpeople" required>
                          </div>

                          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label>DNI:</label>
                            <input type="text" class="form-control" name="dni" id="dni" maxlength="100" placeholder="Digite DNI"
                             required>
                             <input type="hidden" class="form-control" name="dnimg" id="dnimg" maxlength="100" >

                          </div>

                          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label>Grado:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="grado" id="grado" required>
                              <option value="">Seleccionar</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>

                            </select>
                          </div>

                          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label>Grupo:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="seccion" id="seccion" required>
                              <option value="">Seleccionar</option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>

                            </select>

                         </div>


                         <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                           <label>CURP:</label>
                           <input type="text" class="form-control" name="sexo" id="sexo" maxlength="100" placeholder="Digite CURP"
                            required>
                         </div>


                          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label>Turno:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="nivel" id="nivel" required>
                              <option value="">Seleccionar</option>
                              <option value="Matutino">Matutino</option>
                              <option value="Vespertino">Vespertino</option>
                            </select>
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

    </div>

        <div class="modal fade" id="modal-default" name="modal-default" >
          <div class="modal-dialog" style="width: 370px">

            <div class="modal-content" >
            <form id="subida" >
              <div class="modal-header" style="background-color: rgb(60, 141, 188); color: #fff ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class=" fa  fa-user-plus"></i> Importar</h4>
              </div>
              <div class="modal-body" >
                    <div class=""  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px ; padding-bottom: 5px; padding-right: 5px; padding-left: 5px;">
                        <p>Seleccionar un archivo CSV <i class="fa fa-file-excel-o"> </i> &hellip;</p>
                        <input type="file"  id="csv" name="csv" value="Importar" onchange="return validarExt(this)" placeholder="">
                     </div>
                     <div id="resultados"></div><!-- Carga los datos ajax -->
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" value="Importar"><i class=" glyphicon glyphicon-cloud-upload"></i> Importar</button>
                <button type="button"  class="btn btn-default"  data-dismiss="modal">Cancelar</button>
              </div>
            </form>
            </div>
          </div>
        </div>




        <div class="modal fade" id="modal-qr" >
          <div class="modal-dialog" style="">
            <div class="modal-content" >

              <div class="modal-header" style="background-color: rgb(60, 141, 188); color: #fff ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class=" fa  fa-user-plus"></i> Generar Credencial QR</h4>
              </div>
              <div class="modal-body " id="listadoregistros" >
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  style="border: 1px #D8D8D8 solid; border-radius: 5px; padding-top:5px; margin-bottom: 3px;">

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="nv" name="nv">
                          <label>Seleccionar:</label>
                          <select name="rnivel" id="rnivel"  class="form-control selectpicker" data-live-search="true" required >
<!--                             <option value="">Seleccionar</option> -->

                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                            <option value="DNI">DNI</option>
                          </select>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" id="div1" name="div1">
                            <label>Grado:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="rgrado" id="rgrado" required>

                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>

                            </select>
                          </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" id="divs" name="divs">
                            <label>Grado:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="sgrado" id="sgrado" required>

                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>

                            </select>
                          </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" id="div2"name="div2">
                            <label >Grupo:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="rseccion" id="rseccion" required>

                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>



                            </select>
                          </div>



                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" name="div3" id="div3">
                          <label>DNI</label>
                            <input type="text" class="form-control" name="rdni" id="rdni" maxlength="100" placeholder="Digite DNI">
                        </div>
                  </div>


              </div>
              <div class="modal-footer">
                <button type="button"  onclick="rpt()" name="rpt" class="btn btn-default"> <i class=" fa  fa-print"></i> Generar Credencial</button>
                <button type="button"  class="btn btn-default" onclick="limpiar()"  data-dismiss="modal">Cancelar</button>
              </div>

            </div>
          </div>
        </div>


<?php
require 'footer.php';
?>
<script type="text/javascript" src="scripts/people.js"></script>
<script type="text/javascript" src="scripts/myjavae.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  $("#rnivel").val("Matutino");
  $("#rnivel").selectpicker('refresh');

  $("#div3").css("display", "none");
  $("#divs").css("display", "none");


  $("#rnivel").change(function () {
        $("#rnivel option:selected").each(function () {
          seleccion=$(this).val();

           if (seleccion=="DNI") {
             $("#div1").css("display", "none");
             $("#div2").css("display", "none");
             $("#divs").css("display", "none");

             $("#div3").css("display", "block");

          }else if(seleccion=="Matutino"){
            $("#div1").css("display", "block");
            $("#div2").css("display", "block");

            $("#div3").css("display", "none");
            $("#divs").css("display", "none");
          }else if(seleccion=="Vespertino"){
             $("#divs").css("display", "block");
             $("#div2").css("display", "block");

             $("#div1").css("display", "none");
             $("#div3").css("display", "none");
          }else{
             $("#div1").css("display", "block");
            $("#div2").css("display", "block");

            $("#div3").css("display", "none");
            $("#divs").css("display", "none");
          }


        });
    })
});


</script>

<?php

 }
ob_end_flush();
?>
