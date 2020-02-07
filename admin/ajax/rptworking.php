<?php
require_once "../modelos/Rptworking.php";

$p= new Consultas();
switch ($_GET["op"]) {


case 'level': 

        $nivel=$_REQUEST["nivel"];
        $grado=$_REQUEST["grado"];
        $seccion=$_REQUEST["seccion"];
        $fecha_inicio=$_REQUEST["fecha_inicio"];
        $fecha_fin=$_REQUEST["fecha_fin"];
        $diferencia=$_REQUEST["diferencia"];

       

        $rspta = $p->level($nivel,$grado,$seccion,$fecha_inicio,$fecha_fin,$diferencia);
        $data = array();
        $i = 1;
        while ($reg = $rspta->fetch_object()) {
        $marcacion=($diferencia);
            $data[] = array(
                "0" => $i,
                "1" => $reg->nivel,
                "2" => $reg->apellidos,
                "3" => $reg->nombre,
                "4" => $reg->grado,
                "5" => $reg->seccion,
                "6" => $reg->fecha,
                "7" => $reg->entrada,
                "8" => $reg->salida,
                "9"=>($marcacion > $reg->entrada or $marcacion == $reg->entrada)?'<p style="color:black; ">'.$reg->diferencia.'</p>':(($marcacion < $reg->entrada ) ? '<p style="color:red; ">'.$reg->diferencia.'</p>':'<p style="color:black; ">'.$reg->diferencia.'</p>'),
                
            );
            $i++;
        }
        $results = array(
            "sEcho"                => 1, 
            "iTotalRecords"        => count($data),
            "iTotalDisplayRecords" => count($data), 
            "aaData"               => $data);
        echo json_encode($results);
        break;

case 'nivel':

        $nivel=$_REQUEST["nivel"];
        $fecha_inicio=$_REQUEST["fecha_inicio"];
        $fecha_fin=$_REQUEST["fecha_fin"];
        $diferencia=$_REQUEST["diferencia"];
        $rspta = $p->nivel($nivel,$fecha_inicio,$fecha_fin,$diferencia);

        $data = array();
        $i = 1;
        while ($reg = $rspta->fetch_object()) {
             $marcacion=($diferencia);
            $data[] = array(
                "0" => $i,
                "1" => $reg->nivel,
                "2" => $reg->apellidos,
                "3" => $reg->nombre,
                "4" => $reg->grado,
                "5" => $reg->seccion,
                "6" => $reg->fecha,
                "7" => $reg->entrada,
                "8" => $reg->salida,
                "9"=>($marcacion >= $reg->entrada)?'<p style="color:black;">'.$reg->diferencia.'</p>':(($marcacion < $reg->entrada ) ? '<p style="color:red; ">'.$reg->diferencia.'</p>':'<p style="color:black; ">'.$reg->diferencia.'</p>'),
            );
            $i++;
        }
        $results = array(
            "sEcho"                => 1, 
            "iTotalRecords"        => count($data),
            "iTotalDisplayRecords" => count($data), 
            "aaData"               => $data);
        echo json_encode($results);
        break;
}

?>