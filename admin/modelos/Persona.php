<?php 

require "../config/Conexion.php";

Class People
{

	public function __construct()
	{

	} 


	public function insertar($apellidos,$nombre,$dni,$grado,$seccion,$sexo,$nivel,$qr,$year)
	{
		$sql="INSERT INTO people_est (apellidos,nombre,dni,grado,seccion,sexo,nivel,qr,status,year)
		VALUES ('$apellidos','$nombre','$dni','$grado','$seccion','$sexo','$nivel','$qr','1','$year')";
		return ejecutarConsulta($sql);
	}


	public function editar($idpeople,$apellidos,$nombre,$dni,$grado,$seccion,$sexo,$nivel,$qr,$year)
	{
		$sql="UPDATE people_est SET apellidos='$apellidos',nombre='$nombre' ,dni='$dni',grado='$grado',seccion='$seccion' ,sexo='$sexo', nivel='$nivel',qr='$qr' WHERE idpeople='$idpeople'";
		return ejecutarConsulta($sql);
	}


	public function desactivar($idpeople)
	{
		$sql="UPDATE people_est SET status='0' WHERE idpeople='$idpeople'";
		return ejecutarConsulta($sql);
	}


	public function activar($idpeople)
	{
		$sql="UPDATE people_est SET status='1' WHERE idpeople='$idpeople'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($idpeople)
	{
		$sql="DELETE FROM people_est WHERE idpeople='$idpeople'";
		return ejecutarConsulta($sql);
	}

	public function eliminarsel($qr)
	{
		$sql="DELETE FROM people_est WHERE dni in($qr)";
		return ejecutarConsulta($sql);
	}


	public function mostrar($idpeople)
	{
		$sql="SELECT * FROM people_est WHERE idpeople='$idpeople'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql="SELECT * FROM people_est e order by e.idpeople desc";
		return ejecutarConsulta($sql);		
	}


	public function bloque($nivel,$grado,$seccion)
    {
     $sql = "SELECT * FROM people_est pe WHERE  pe.nivel='$nivel' AND pe.grado='$grado' AND pe.seccion='$seccion'";
        return ejecutarConsulta($sql);
    }


    public function unique($dni)
    {
                $sql = "SELECT * FROM people_est pe WHERE  pe.dni='$dni'";
        return ejecutarConsulta($sql);
    }

    public function general($nivel)
    {
                $sql = "SELECT * FROM people_est pe WHERE  pe.nivel='$nivel'";
        return ejecutarConsulta($sql);
    }

}

?>