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
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <h4 class="box-title">INSTITUCION

                          </h4>
                        </div>
                      </div>

                      <div class="box-tools pull-right">
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="border: 2px #D8D8D8 solid; border-radius: 5px; padding-top:5px">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Año</th>
                            <th>Logotipo</th>
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

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>INSTUTUCION:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre de la institucion" required>
                             <input type="hidden" class="form-control" name="identidad" id="identidad" maxlength="100" placeholder="NOMBRE"
                             required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>AÑO EN CURSO:</label>
                            <input type="text" class="form-control" name="year" id="year" maxlength="100" placeholder="Ingresar año"
                             required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>LOGOTIPO:</label>
                            <input type="file"  onchange="return validarExt(this)" class="form-control" name="logo" id="logo">

                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12"  style="border: 2px #D8D8D8 solid; border-radius: 5px; margin-top: 5px; padding-top:5px">
                              <p align="center"><a href="#"  onclick="clearimg()"> Cancelar </a></p>
                              <div id="visorArchivo"></div>

                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" style="border: 2px #D8D8D8 solid; border-radius: 5px;margin-top: 5px; margin-left: 5px; padding-top:5px"><p align="center">Imagen Actual</p>
                              <input type="hidden" name="imagenactual" id="imagenactual">
                              <img src="" width="150px" height="120px"  id="imagenmuestra">
                            </div>
                          </div>



                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div>

<?php

require 'footer.php';
?>
<script type="text/javascript" src="scripts/entidad.js"></script>

<?php

ob_end_flush();
?>
