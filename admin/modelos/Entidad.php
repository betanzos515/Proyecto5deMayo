<?php 

require "../config/Conexion.php";

Class Entidad
{

	public function __construct()
	{

	}

	public function editar($identidad,$nombre,$year,$logo)
	{
		$sql="UPDATE entidad SET nombre='$nombre',year='$year',logo='$logo' WHERE identidad='$identidad'";
		return ejecutarConsulta($sql);
	}

	public function update($identidad,$nombre,$year,$logoac)
	{
		$sql="UPDATE entidad SET nombre='$nombre',year='$year',logo='$logoac' WHERE identidad='$identidad'";
		return ejecutarConsulta($sql);
	}


	public function mostrar($identidad)
	{
		$sql="SELECT * FROM entidad ";
		return ejecutarConsultaSimpleFila($sql);
	}


	public function listar()
	{
		$sql="SELECT * FROM entidad ";
		return ejecutarConsulta($sql);		
	}



}

?>