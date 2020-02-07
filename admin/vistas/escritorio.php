<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
 header("Location: login.html");
}

require "../config/Conexion.php";
require 'header.php';


?>

<div class="content-wrapper">
<section class="content">
<!-- Inicio Contenido PHP-->
<div class="row">
  <div class="col-lg-12">
    <div class="main-box clearfix">
        <div class="col-md-12">

        	<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">INICIO</a></li>
            </ul>
            <div class="tab-content" id="tab-content">
              <div class="tab-pane active" id="tab_1">

                <div class="main-box-body clearfix"">

                <img src="../files/images/escritorio.png" class="img-responsive" alt="" width="1040px" height="">
                </div>


              </div>

            </div>

          </div>
        </div>



    </div>

</div>

</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!-- Fin Contenido PHP-->
<?php

require 'footer.php';

?>


 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php

ob_end_flush();
?>
