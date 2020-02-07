<?php 
require_once "../modelos/Persona.php";
include('../public/phpqrcode/qrlib.php');
$people=new people();


$idpeople=isset($_POST["idpeople"])? limpiarCadena($_POST["idpeople"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$dni=isset($_POST["dni"])? limpiarCadena($_POST["dni"]):"";
$grado=isset($_POST["grado"])? limpiarCadena($_POST["grado"]):"";
$seccion=isset($_POST["seccion"])? limpiarCadena($_POST["seccion"]):"";
$sexo=isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
$nivel=isset($_POST["nivel"])? limpiarCadena($_POST["nivel"]):"";
$dnimg=isset($_POST["dnimg"])? limpiarCadena($_POST["dnimg"]):"";



$year=date("Y-m-d");
$calidad='H';
$tamanio=5;
$borde=1;




switch ($_GET["op"]){
	case 'guardaryeditar':

	if (empty($idpeople)){
		$image_location = "../files/qrcodes/";
		$qr = $dni.'.png';
		QRcode::png($dni, $image_location.$qr,$calidad,$tamanio,$borde);

		$rspta=$people->insertar($apellidos,$nombre,$dni,$grado,$seccion,$sexo,$nivel,$qr,$year);
		echo $rspta ? "registro guardado" : "registro no se pudo guardar";
	}
	else {

		if ($dni != $dnimg) {
			unlink('../files/qrcodes/'.$dnimg.'.png');
		} 

		$image_location = "../files/qrcodes/";
		$qr = $dni.'.png';
		QRcode::png($dni, $image_location.$qr,$calidad,$tamanio,$borde);

		$rspta=$people->editar($idpeople,$apellidos,$nombre,$dni,$grado,$seccion,$sexo,$nivel,$qr,$year);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
	}
	break;

	case 'mostrar':
	$idpeople=$_GET['idpeople'];
	$rspta=$people->mostrar($idpeople);
	echo json_encode($rspta);
	break;

	case 'desactivar':
		$rspta=$people->desactivar($idpeople);
 		echo $rspta ? "estudiante Desactivado" : "estudiante no se puede desactivar";
	break;

	case 'activar':
		$rspta=$people->activar($idpeople);
 		echo $rspta ? "estudiante activado" : "estudiante no se puede activar";
	break;


	case 'eliminar':
		$idpeople=$_GET['id'];
		$qr=$_GET['qr'];
		unlink('../files/qrcodes/'.$qr);
		$rspta=$people->eliminar($idpeople);

 		echo $rspta ? "registro eliminado" : "registro no se puede eliminar";
	break;




	case 'eliminarsel':
	$id=$_GET['qr'];
	$idd=explode(" ", $id);
	if ($id<>"") {
		foreach ($idd as $keyy) {
		unlink('../files/qrcodes/'.$keyy.'.png');
			}
	}
	

	

		$myid=$_GET['qr'];
		$qr=str_replace(' ',',', $myid);
		$rspta=$people->eliminarsel($qr);
 		echo $rspta ? "registros eliminados" : "registros no se puede eliminar";
	break;



	case 'listar':
	$rspta=$people->listar();
	$data= Array();
	$i = 1;
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>' <input type="checkbox"  class="checkitem" id="checkitem" value="'. $reg->dni.'"> ' . $i,
			"1"=>$reg->apellidos,
 			"2"=>$reg->nombre,
			"3"=>$reg->dni,	
			"4"=>$reg->grado,
			"5"=>$reg->seccion,
			"6"=>$reg->nivel,
			"7"=>($reg->status)?'<span class="btn btn-success btn-xs" onclick="desactivar('.$reg->idpeople.')"> Activo</span>':
 				'<span class="btn btn-danger btn-xs" onclick="activar('.$reg->idpeople.')">Inactivado</span>',
			"8"=>
			' <a href="#" onclick="mostrar('.$reg->idpeople.')"><i data-toggle="tooltip" title="Modificar" class="glyphicon glyphicon-pencil" style="color: rgb(0, 166, 90);"></i></a>'.
 			' <a href="#" onclick="eliminar(' . $reg->idpeople.',\''.$reg->qr.'\')"><i data-toggle="tooltip" title="Eliminar" class="glyphicon glyphicon-trash" style="color: red;"></i></a>' 
 			,
 			
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

}
?>