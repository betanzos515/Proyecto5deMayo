<?php
require "../config/Conexion.php";
include('../public/phpqrcode/qrlib.php'); 

					$calidad='H';
					$tamanio=5;
					$borde=1;
					$image_location = "../files/qrcodes/";
					$year=date("Y-m-d");
					$status=1;

				if ($_FILES['csv']['size'] > 0) {
					$csv = $_FILES['csv']['tmp_name'];
					$handle = fopen($csv,'r');


					while ($data = fgetcsv($handle,1000,",","'")){
							$qr=$data[2].".png";
							$dni=$data[2];


						if ($data[0]) { 
							$image_name = $qr;
   							QRcode::png($dni, $image_location.$qr,$calidad,$tamanio,$borde);


						$query = "INSERT INTO people_est(apellidos,nombre,dni,grado,seccion,sexo,nivel,qr,status,year) VALUES  ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$qr."','".$status."','".$year."')";
				                 $result = mysqli_query($conexion ,$query);
						}
					}
					echo 'OK';
				}
?> 