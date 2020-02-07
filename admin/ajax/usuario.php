<?php
session_start(); 
require_once "../modelos/Usuario.php";


<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

$usuario=new Usuario();

$iduser=isset($_POST["iduser"])? limpiarCadena($_POST["iduser"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':


		$clavehash=hash("SHA256",$clave);

		if (empty($iduser)){
			$rspta=$usuario->insertar($nombre,$login,$clavehash);
			echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
		}
		else {
			$rspta=$usuario->editar($iduser,$nombre,$login,$clavehash);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($iduser);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($iduser);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($iduser);
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();

 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->login=='admin')?'<button disabled class="btn btn-primary btn-sm" onclick="mostrar('.$reg->iduser.')"><i class="fa fa-pencil"></i></button>':
 				'<a href="#"  onclick="mostrar('.$reg->iduser.')"><i data-toggle="tooltip" title="Modificar" class="glyphicon glyphicon-pencil" style="color: rgb(0, 166, 90);"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->login,
 				"3"=>($reg->condicion=='1' and $reg->login=='admin')?'<span class="btn btn-success btn-xs" disabled> Activo</span>':(($reg->condicion=='1' and $reg->login<>'admin')?'<span class="btn btn-success btn-xs" onclick="desactivar('.$reg->iduser.')"> Activo</span>'  :
 				'<span class="btn btn-danger btn-xs" onclick="activar('.$reg->iduser.')">Inactivado</span>')
 				);
 		}
 		$results = array(
 			"sEcho"=>1, 
 			"iTotalRecords"=>count($data), 
 			"iTotalDisplayRecords"=>count($data), 
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

 
	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];


		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {

	        $_SESSION['iduser']=$fetch->iduser;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['nombre1']=$fetch->nombre;
	        $_SESSION['login']=$fetch->login;

	    }
	    echo json_encode($fetch);
	break;

	case 'salir':
  
        session_unset();

        session_destroy();

        header("Location: ../index.php");

	break;
}
?>