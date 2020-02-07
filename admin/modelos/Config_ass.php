<?php 

require "../config/Conexion.php";


Class Config_ass
{

	public function __construct()
	{

	}


	public function editar($idassistance,$idpeople,$h_entrada,$h_salida)
	{
		$sql="UPDATE assistance a SET a.idpeople='$idpeople',a.h_entrada='$h_entrada',a.h_salida='$h_salida' WHERE a.idassistance='$idassistance'";
		return ejecutarConsulta($sql);
	}


	public function editar1($idassistance,$idpeople,$h_entrada)
	{
		$sql="UPDATE assistance a SET a.idpeople='$idpeople',a.h_entrada='$h_entrada',a.h_salida=NULL WHERE a.idassistance='$idassistance'";
		return ejecutarConsulta($sql);
	}


	public function mostrar($idassistance)
	{

		$sql="SELECT a.idassistance,p.idpeople,p.nombre,p.apellidos,time(a.h_entrada) as h_entrada,DATE(a.fecha) as fecha,time(a.h_salida) as h_salida FROM assistance a inner join people_est p on a.idpeople=p.idpeople WHERE idassistance='$idassistance'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function eliminar($idassistance)
	{
		$sql="DELETE FROM assistance WHERE idassistance='$idassistance'";
		return ejecutarConsulta($sql);
	}


	public function eliminarsel($id)
	{
		$sql="DELETE FROM assistance WHERE idassistance in($id)";
		return ejecutarConsulta($sql);
	}


	public function listar()
	{
		$sql="SELECT a.idassistance,date(a.fecha) as fecha,time(a.h_entrada) as entrada,time(a.h_salida) as salida,p.apellidos,p.nombre,p.dni,p.nivel ,p.grado,p.seccion FROM assistance a inner join people_est p on a.idpeople=p.idpeople";
		return ejecutarConsulta($sql);		
	}



/*	public function listarl()
	{
			$sql="SELECT time(a.h_entrada) as entrada,time(a.h_salida) as salida , p.apellidos,p.nombre FROM  assistance a inner join people_est p on a.idpeople=p.idpeople WHERE DATE(a.fecha)=curdate() order by  time(a.h_entrada)  desc ";
		return ejecutarConsulta($sql);		
	}*/

}

?>