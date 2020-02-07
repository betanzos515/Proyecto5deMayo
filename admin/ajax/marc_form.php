<?php

    date_default_timezone_set('America/Lima');
    require_once ("../config/Conexion.php");
    if (empty($_POST['dni'])){
        $errors[] = "Ingresa DNI.";

    } elseif (!empty($_POST['dni'])){

        $dni = mysqli_real_escape_string($conexion,(strip_tags($_POST["dni"],ENT_QUOTES)));
        $fecha=date('Y-m-d');
        $h_entrada=date('H:i:s');

        //CONSULTA QUE VALIDA SI YA MARCO LA ENTRADA PARA MARCAR LA SALIDA
        $consulta = "SELECT a.idpeople,a.idassistance,a.h_salida,a.h_entrada  FROM  assistance a inner join people_est p on a.idpeople=p.idpeople where DATE(a.fecha)=curdate() and p.dni='$dni'";
        $respuesta = mysqli_query($conexion,$consulta);

        $fil="";
        $sl="";

        while ( $fils=mysqli_fetch_row($respuesta)) {
           $fil=$fils[1];
           $sl=$fils[2];
           $inputTime=$fils[3];
        }
         
        if ($fil==0) {
            $sq = "SELECT idpeople,dni FROM  people_est where dni='$dni'";
            $quer = mysqli_query($conexion,$sq);
            $iddni="";

            while ( $filas=mysqli_fetch_row($quer)) {
                $idpeople=$filas[0];
                $iddni=$filas[1];
            }
               if ($iddni==$dni) {
                    $sql = "INSERT INTO assistance (idpeople, h_entrada,fecha) VALUES ('$idpeople','$h_entrada','$fecha')";
                    $query = mysqli_query($conexion,$sql);

                    if ($query) {
                        echo "<script>jQuery(function(){    swal({type: 'success', title: 'Exito',text: 'Entrada registrada con exito!',showConfirmButton: false,timer: 1200});   });</script>";
                     } else {
                        echo "<script>jQuery(function(){    swal({type: 'error', title: 'Error',text: 'Entrada nose registro!',showConfirmButton: false,timer: 1200});   });</script>";
                    }
                   
                }else{
                    echo "<script>jQuery(function(){    swal({type: 'warning', title: 'Advertencia',text: 'Datos desconocidos, intente de nuevo!',showConfirmButton: false,timer: 1200});   });</script>";
                } 
          
        }elseif($fil<>0) {

         $horaentrada=$inputTime;
         $nuevaHora=Date('H:i',strtotime($horaentrada)+600);

            if ($sl=="") {

                if($nuevaHora>$h_entrada){

                    echo "<script>jQuery(function(){    swal({type: 'warning', title: 'Advertencia',text: 'Ud. Ya marco su entrada!',showConfirmButton: false,timer: 1200});   });</script>";
                }else{
                    $sql = "UPDATE assistance a SET a.h_salida='$h_entrada' where a.idassistance='$fil'";
                    $query = mysqli_query($conexion,$sql);

                    if ($query) {
                        echo "<script>jQuery(function(){    swal({type: 'success', title: 'Exito',text: 'Salida registradas con exito!',showConfirmButton: false,timer: 1200});   });</script>";
                    } else {
                        echo "<script>jQuery(function(){    swal({type: 'error', title: 'Error',text: 'Salida nose registro!',showConfirmButton: false,timer: 1200});   });</script>";
                    }
                }

            } else {
                echo "<script>jQuery(function(){    swal({type: 'warning', title: 'Advertencia',text: 'Ud. ya a marcado su entrada y salida!',showConfirmButton: false,timer: 1200});   });</script>";
            }

        } else  {
            echo "<script>jQuery(function(){    swal({type: 'error', title: 'Error',text: 'Error desconocido!',showConfirmButton: false,timer: 1200});   });</script>";
        }

    } else {
        echo "<script>jQuery(function(){    swal({type: 'error', title: 'Error',text: 'Error desconocido!',showConfirmButton: false,timer: 1200});   });</script>";
        //$errors[] = "desconocido.";
    }


    if (isset($errors)){           
            ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> 
                    <?php
                        foreach ($errors as $error) {
                                echo $error;
                            }
                        ?>
            </div>
            <?php
    }

    if (isset($messages)){
                ?>
                <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Bien hecho!</strong>
                        <?php
                            foreach ($messages as $message) {
                                    echo $message;
                                }
                            ?>
                </div>
                <?php
    }
?>