<?php 

require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	public function insertar($nombre,$login,$clave)
	{
		$sql="INSERT INTO user (nombre,login,clave,condicion)
		VALUES ('$nombre','$login','$clave','1')";
		return ejecutarConsulta($sql);
		
	}


	public function editar($iduser,$nombre,$login,$clave)
	{
		$sql="UPDATE user SET nombre='$nombre',login='$login',clave='$clave' WHERE iduser='$iduser'";
		return ejecutarConsulta($sql);

	}


	public function desactivar($iduser)
	{
		$sql="UPDATE user SET condicion='0' WHERE iduser='$iduser'";
		return ejecutarConsulta($sql);
	}


	public function activar($iduser)
	{
		$sql="UPDATE user SET condicion='1' WHERE iduser='$iduser'";
		return ejecutarConsulta($sql);
	}


	public function mostrar($iduser)
	{
		$sql="SELECT * FROM user WHERE iduser='$iduser'";
		return ejecutarConsultaSimpleFila($sql);
	}


	public function listar()
	{
		$sql="SELECT * FROM user";
		return ejecutarConsulta($sql);		
	}



	public function verificar($login,$clave)
    {
    	$sql="SELECT iduser,nombre,login FROM user WHERE login='$login' AND clave='$clave' AND condicion='1'"; 
    	return ejecutarConsulta($sql);  
    }
}

?>