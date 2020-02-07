<?php 
require_once "../modelos/Config_ass.php";


//RECOGE DE ENTRADA DE FORMA DESCEN
	$consulta = "SELECT a.idassistance,a.idpeople,time(a.h_entrada),max(time(a.h_salida)) FROM  assistance a where DATE(a.fecha)=curdate() order by time(a.h_entrada) desc ";
        $respuesta = mysqli_query($conexion,$consulta);

	while ( $fils=mysqli_fetch_row($respuesta)) {
           $fil1=$fils[0];
           $fil2=$fils[2];
           $fil3=$fils[3];
    }
//RECOGE DE SALIDA DE FORMA DESCEN
		$consulta1 = "SELECT a.idassistance,a.idpeople,max(time(a.h_entrada)),time(a.h_salida) FROM  assistance a where DATE(a.fecha)=curdate() order by time(a.h_salida) desc ";
        $respuesta1 = mysqli_query($conexion,$consulta1);

	while ( $fs=mysqli_fetch_row($respuesta1)) {
           $f1=$fs[0];
           $f2=$fs[2];
           $f3=$fs[3];
    }


$config_ass=new Config_ass();

$idassistance=isset($_POST["idassistance"])? limpiarCadena($_POST["idassistance"]):"";
$idpeople=isset($_POST["idpeople"])? limpiarCadena($_POST["idpeople"]):"";
$h_entrada=isset($_POST["h_entrada"])? limpiarCadena($_POST["h_entrada"]):"";
$h_salida=isset($_POST["h_salida"])? limpiarCadena($_POST["h_salida"]):"";

switch ($_GET["op"]){

	case 'guardaryeditar':

	if (empty($idassistance)){
		$rspta=$config_ass->insertar($idpeople,$h_entrada,$h_salida);
		echo $rspta ? "registro guardado" : "registro no se pudo guardar";
	}elseif (empty($h_salida)) {
		$rspta=$config_ass->editar1($idassistance,$idpeople,$h_entrada);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
	}else {
		$rspta=$config_ass->editar($idassistance,$idpeople,$h_entrada,$h_salida);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
	}
	break;

	case 'eliminar':
		$rspta=$config_ass->eliminar($idassistance);
 		echo $rspta ? "registro eliminado" : "registro no se puede eliminar";
	break;

	case 'eliminarsel':
		$myid=$_POST['id'];
		$id=str_replace(' ',',', $myid);
		$rspta=$config_ass->eliminarsel($id);
 		echo $rspta ? "Asistencias eliminadas" : "registros no se puede eliminar";
	break;

	case 'mostrar':
	$rspta=$config_ass->mostrar($idassistance);
 		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta=$config_ass->listar();
	$data= Array();
	$i = 1;
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>' <input type="checkbox"  class="checkitem" id="checkitem" value="'. $reg->idassistance.'">',
			"1"=>$i,
			"2"=>$reg->apellidos,
			"3"=>$reg->nombre,
			"4"=>$reg->grado,
			"5"=>$reg->seccion,
			"6"=>$reg->nivel,
			"7"=>$reg->fecha,
			"8"=>$reg->entrada,
			"9"=>$reg->salida,
      		"10"=>
			' <a href="#" onclick="mostrar('.$reg->idassistance.')"><i data-toggle="tooltip" title="Modificar" class="glyphicon glyphicon-pencil" style="color: rgb(0, 166, 90);"></i></a>'.
 			' <a href="#" onclick="eliminar(' . $reg->idassistance.')"><i data-toggle="tooltip" title="Eliminar" class="glyphicon glyphicon-trash" style="color: red;"></i></a>' ,
		);
		$i++;
	}
	$results = array(
 			"sEcho"=>1,
 			"iTotalRecords"=>count($data), 
 			"iTotalDisplayRecords"=>count($data), 
 			"aaData"=>$data);
	echo json_encode($results);

	break;



//LISTAR INDEX TABLAS
	case 'listar1':

			if ($fil3>$f2) {
    			       $query = "SELECT time(a.h_entrada) as h_entrada,time(a.h_salida) as end , p.apellidos,p.nombre FROM  assistance a inner join people_est p on a.idpeople=p.idpeople WHERE DATE(a.fecha)=curdate() order by time(a.h_salida) desc";
					        $resultado = mysqli_query($conexion,$query);

					    	$data= Array();
					        while ($reg=mysqli_fetch_array($resultado)) {
					        		$formatEntrada=date("g:i A",strtotime($reg[0]));
					        		if($reg[1]==""){
					        		$formatSalida="";
					        	}else{
					        		$formatSalida=date("g:i A",strtotime($reg[1]));
					        	}

					                $data[]=array(
					                	"0"=>$formatEntrada,
										"1"=>$formatSalida,
										"2"=>$reg[2],
										"3"=>$reg[3]
					               );
					              }
					        $results = array(
						 			"sEcho"=>1,
						 			"iTotalRecords"=>count($data),
						 			"iTotalDisplayRecords"=>count($data),
						 			"aaData"=>$data);
							echo json_encode($results);
    		} elseif ($fil3<$f2){
    			 $query = "SELECT time(a.h_entrada) as h_entrada,time(a.h_salida) as end , p.apellidos,p.nombre FROM  assistance a inner join people_est p on a.idpeople=p.idpeople WHERE DATE(a.fecha)=curdate() order by time(a.h_entrada) desc";
					        $resultado = mysqli_query($conexion,$query);

					    	$data= Array();

					        while ($reg=mysqli_fetch_array($resultado)) {
					        	$formatEntrada=date("g:i A",strtotime($reg[0]));
					        	if($reg[1]==""){
					        		$formatSalida="";
					        	}else{
					        		$formatSalida=date("g:i A",strtotime($reg[1]));
					        	}

					                $data[]=array(
					                	"0"=>$formatEntrada,
										"1"=>$formatSalida,
										"2"=>$reg[2],
										"3"=>$reg[3]
					               );
					              }
					        $results = array(
						 			"sEcho"=>1, 
						 			"iTotalRecords"=>count($data),
						 			"iTotalDisplayRecords"=>count($data), 
						 			"aaData"=>$data);
							echo json_encode($results);
    	
    		}else{
					$query = "SELECT time(a.h_entrada) as h_entrada,time(a.h_salida) as end , p.apellidos,p.nombre FROM  assistance a inner join people_est p on a.idpeople=p.idpeople WHERE DATE(a.fecha)=curdate() order by a.idassistance desc";
					        $resultado = mysqli_query($conexion,$query);

					    	$data= Array();

					        while ($reg=mysqli_fetch_array($resultado)) {
					        	$formatEntrada=date("g:i A",strtotime($reg[0]));
					        	if($reg[1]==""){
					        		$formatSalida="";
					        	}else{
					        		$formatSalida=date("g:i A",strtotime($reg[1]));
					        	}
					                $data[]=array(
					                	"0"=>$formatEntrada,
										"1"=>$formatSalida,
										"2"=>$reg[2],
										"3"=>$reg[3]
					               );
					              }
					        $results = array(
						 			"sEcho"=>1,
						 			"iTotalRecords"=>count($data),
						 			"iTotalDisplayRecords"=>count($data),
						 			"aaData"=>$data);
							echo json_encode($results);
    		}

	break;

}
?>