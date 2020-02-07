<?php
require 'header.php';

require "admin/config/Conexion.php";

$consulta="SELECT * FROM entidad";
$resultado=mysqli_query($conexion, $consulta);
$filae=mysqli_fetch_row($resultado) ;

?>
<link rel="stylesheet" type="text/css" href="js/styles.css">
<link rel="stylesheet" type="text/css" href="js/style.css">

<style>
.luz.on{
  /*color: #ff0000;color del texto al cambiar rojo*/
  /*color: #01DF01;/*color del texto al cambiar VERDE*/
  color: #fff;/*color del texto al cambiar celeste*/
  text-shadow:
     1px  1px rgba(255, 255, 255, .1),
    -1px -1px rgba(0, 0, 0, .88),
     0px  0px 25px #0099ff; /*color de la luz del texto celeste rgb*/
     /*0px  0px 20px #FA5858;/*color de la luz del texto rojo rgb*/
    /* 0px  0px 20px #80FF00;/*color de la luz del texto VERDE rgb*/
}
.luz{
  font-size:30.5px;
  color: #fff;
  text-shadow:
     1px  1px rgba(255, 255, 255, .1),
    -1px -1px rgba(0, 0, 0, .88);
}
</style>

 <style>
    #tbllistado > tbody > tr:nth-child(1) {
      background: #1755c6;
      color: #fff;
    }
</style>
<div class="content-wrapper" style="margin-bottom: -2px;">
    <div class="container">

      <div class="col-md-10 col-md-offset-1" style="margin-top: 5px">

          <div class="box box-solid">

            <!-- /.box-header -->

              <div class="box-body text-center">

                <div id="QR-Code" class="container" style="width:100%">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: 3px #1755c6 solid; border-radius: 5px; padding-top:7px; margin-bottom: 7px;">
                        <h4  style="font-family: oswald, Arial; width:100%;float:left; text-align: center"><marquee></marquee></h4>
                    </div>

                  <div class="panel"  style="color: #ffff">
                        <div class="panel-heading"   style="display: inline-block;width: 100%; background-color: #1755c6">
                            <h4 class="luz" id="blink" style="width:100%;" ><?php echo utf8_decode($filae[1]); ?></h4>
                        </div>

                        <div class="panel-body" style="border: 2px #1789c6 solid;">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: 2px #1789c6 solid; border-radius: 5px; padding-top:10px; margin-bottom: 10px;background-color: #fff; margin-top: 0px">

                                  <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="wrap row" style="margin-left: 30px;">
                                        <div class="widget">
                                            <div class="fecha" style="padding-top: 0px;">
                                              <p id="diaSemana" class="diaSemana"></p>
                                              <p id="dia" class="dia"></p>
                                              <p>de</p>
                                              <p id="mes" class="mes"></p>
                                              <p>de</p>
                                              <p id="year" class="year"></p>
                                            </div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                      <div class="reloj widget">
                                              <p id="horas" class="horas"></p>
                                              <p>:</p>
                                              <p id="minutos" class="minutos"></p>
                                              <p>:</p>
                                              <p id="mes" class="mes"></p>
                                                <p id="segundos" class="segundos"></p>
                                                <p id="ampm" class="ampm"></p>
                                        </div>
                                  </div>


                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <div class="row">
                                      <form name="add_dni" id="add_dni">
                                              <div class="input-group input-group-sm col-xs-9 col-md-9 col-md-offset-2 col-xs-offset-2" >
                                                <input type="text" autofocus="autofocus" class="form-control" name="dni" id="dni" placeholder="Numero de Identificacion" required>
                                                    <span class="input-group-btn">
                                                      <button type="submit" id="btnGuardar" class="btn btn-success btn-flat"><i class="fa  fa-check"></i></button>
                                                    </span>
                                              </div>
                                      </form>
                                 </div>

                              </div>
                            </div>







                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: 2px #1789c6 solid; border-radius: 0px; padding-top:7px">
                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 table-responsive " style="text-align: center; ">
                                    <div class="well" style="position: relative;display: inline-block;">
                                            <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
                                            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                                    </div>

                                    <div style="width: 78%;margin: 0 auto; ">
                                        <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
                                    </div>
                                    <!-- BUTTOOM HIDE -->
                                    <div class="well hidden" style="padding:5px; margin-bottom:1px;">
                                        <select class="form-control" id="camera-select"></select>
                                        <div class="form-group">
                                            <input id="image-url" type="text" class="form-control" placeholder="Image url">
                                            <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-upload"></span></button>
                                            <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-picture"></span></button>
                                            <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
                                            <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-pause"></span></button>
                                            <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>
                                         </div>
                                    </div>

                                    <!-- ZOOM HIDE -->
                                    <div class="well hidden" style="width: 100%;">
                                            <label id="zoom-value" width="100">Zoom: 2</label>
                                            <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
                                            <label id="brightness-value" width="100">Brightness: 0</label>
                                            <input id="brightness" onchange="Page.changeBrightness();" type="range" min="0" max="128" value="0">
                                            <label id="contrast-value" width="100">Contrast: 0</label>
                                            <input id="contrast" onchange="Page.changeContrast();" type="range" min="0" max="64" value="0">
                                            <label id="threshold-value" width="100">Threshold: 0</label>
                                            <input id="threshold" onchange="Page.changeThreshold();" type="range" min="0" max="512" value="0">
                                            <label id="sharpness-value" width="100">Sharpness: off</label>
                                            <input id="sharpness" onchange="Page.changeSharpness();" type="checkbox">
                                            <label id="grayscale-value" width="100">grayscale: off</label>
                                            <input id="grayscale" onchange="Page.changeGrayscale();" type="checkbox">
                                            <br>
                                            <label id="flipVertical-value" width="100">Flip Vertical: off</label>
                                            <input id="flipVertical" onchange="Page.changeVertical();" type="checkbox">
                                            <label id="flipHorizontal-value" width="100">Flip Horizontal: off</label>
                                            <input id="flipHorizontal" onchange="Page.changeHorizontal();" type="checkbox">
                                    </div>
                                </div>

                                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12" >
                                      <div class="row">
                                          <div id="result" class="thumbnail">
                                                     <div id="loader"></div>
                                                    <div class="panel-body table-responsive" >
                                                           <table id="tbllistado" class=" table table-striped table-bordered table-condensed table-hover responsive " style="width:100%; color: #1755c6;">
                                                            <thead>
                                                                  <th class="text-center">Entrada </th>
                                                                  <th class="text-center">Salida </th>
                                                                  <th class="text-center">Apellidos</th>
                                                                  <th class="text-center">Nombres</th>
                                                          </thead>
                                                          <tbody></tbody>
                                                          </table>
                                                    </div>

                                          </div>
                                      </div>
                                </div>
                          </div>



                            <div id="resultados"></div>
                          <div class="panel-footer">
                          </div>
                        </div>
                </div>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </div>
    <!-- /.container -->
</div>

<audio id="audio" controls style="display: none"><source src="js/beep.mp3" type="audio/mp3"></audio>

  <!--Fin-Contenido-->

<?php
require 'footer.php';
?>


            <script type="text/javascript" src="js/filereader.js"></script>
            <script type="text/javascript" src="js/qrcodelib.js"></script>
            <script type="text/javascript" src="js/webcodecamjquery.js"></script>
            <script type="text/javascript" src="js/mainjquery.js"></script>
            <script type="text/javascript" src="js/reloj.js"></script>



<script>
(function() {

setInterval(function(){
  var el = document.getElementById('blink');
  if(el.className == 'luz'){
      el.className = 'luz on';
  }else{
      el.className = 'luz';
  }

},500);

})();
</script>
