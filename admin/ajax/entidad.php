<?php 
require_once "../modelos/Entidad.php";
$entidad=new Entidad();

$identidad=isset($_POST["identidad"])? limpiarCadena($_POST["identidad"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$year=isset($_POST["year"])? limpiarCadena($_POST["year"]):"";
$logo=isset($_POST["logo"])? limpiarCadena($_POST["logo"]):"";
$imagenactual=isset($_POST["imagenactual"])? limpiarCadena($_POST["imagenactual"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		

	if (!file_exists($_FILES['logo']['tmp_name']) || !is_uploaded_file($_FILES['logo']['tmp_name']))
	{
		$logoac=$_POST["imagenactual"];
	}
	else 
	{
		$ext = explode(".", $_FILES["logo"]["name"]);
		if ($_FILES['logo']['type'] == "image/jpg" || $_FILES['logo']['type'] == "image/jpeg" || $_FILES['logo']['type'] == "image/png")
		{
			$logo = round(microtime(true)) . '.' . end($ext);
			move_uploaded_file($_FILES["logo"]["tmp_name"], "../files/ie/" . $logo);
		}
	}



	if ($logo!="") {
		$ruta=is_file('../files/ie/'.$imagenactual);
		if ($ruta<>NULL) {
		unlink('../files/ie/'.$imagenactual);
		$rspta=$entidad->editar($identidad,$nombre,$year,$logo);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
		}else{
		$rspta=$entidad->editar($identidad,$nombre,$year,$logo);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
		}

	}else{
		$rspta=$entidad->update($identidad,$nombre,$year,$logoac);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";

		}


		


	break;


	case 'mostrar':
	$rspta=$entidad->mostrar($identidad);

	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta=$entidad->listar();

	$data= Array();

	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>//($reg->condicion)?
			' <a  href="#" onclick="mostrar('.$reg->identidad.')"><i data-toggle="tooltip" title="Modificar" class="glyphicon glyphicon-pencil" style="color: rgb(0, 166, 90);"></i></a>',
 			"1"=>$reg->nombre,
 			"2"=>$reg->year,
 			"3"=>"<a href='../files/ie/".$reg->logo."' data-lighter>
			<img src='../files/ie/".$reg->logo."' height='35px' width='35px' > </a>",
		);
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