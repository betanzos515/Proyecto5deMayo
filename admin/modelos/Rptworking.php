<?php 

require "../config/Conexion.php";



Class Consultas
{
    public function __construct()
    {

    }

  public function level($nivel,$grado,$seccion,$fecha_inicio,$fecha_fin,$diferencia)
    {
                $sql = "SELECT p.nivel,p.apellidos ,p.nombre,p.grado,p.seccion,date(a.fecha) as fecha,time(a.h_entrada)as entrada ,time(a.h_salida) as salida, SUBTIME(time('$diferencia'),time(a.h_entrada)) as diferencia FROM assistance a inner join people_est p on a.idpeople=p.idpeople WHERE  DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND p.nivel='$nivel' AND p.grado='$grado' AND p.seccion='$seccion'";
      
       return ejecutarConsulta($sql);
    }

  public function nivel($nivel,$fecha_inicio,$fecha_fin,$diferencia)
    {
                $sql = "SELECT p.nivel,p.apellidos ,p.nombre,p.grado,p.seccion,date(a.fecha) as fecha,time(a.h_entrada)as entrada ,time(a.h_salida) as salida, SUBTIME(time('$diferencia'),time(a.h_entrada)) as diferencia FROM assistance a inner join people_est p on a.idpeople=p.idpeople WHERE  DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND p.nivel='$nivel'";
      
       return ejecutarConsulta($sql);
    }


  public function nivelr($nivel,$fecha_inicio,$fecha_fin,$diferencia)
    {
                $sql = "SELECT p.nivel,p.apellidos ,p.nombre,p.grado,p.seccion,date(a.fecha) as fecha,time(a.h_entrada)as entrada ,time(a.h_salida) as salida, SUBTIME(time('$diferencia'),time(a.h_entrada)) as diferencia FROM assistance a inner join people_est p on a.idpeople=p.idpeople WHERE  DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND p.nivel='$nivel'";
      
       return ejecutarConsulta($sql);
    }



 
}

?>