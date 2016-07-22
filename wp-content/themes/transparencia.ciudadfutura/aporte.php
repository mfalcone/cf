<?php
if (isset($_POST['data'])) {

$con = mysqli_connect("localhost","futura_wp","mJ4WACfnjv");
//$con = mysqli_connect("localhost","root","root");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysqli_select_db( $con,"futura_wp");
//mysqli_select_db( $con,"ciudadfutura");

$data = $_POST['data'];
$decoded = json_decode($data);

$nombre=$decoded->{'nombre'};
$domicio=$decoded->{'domicilio'};
$dni=$decoded->{'dni'};
$telefono=$decoded->{'telefono'};
$email=$decoded->{'email'};
$facebook=$decoded->{'facebook'};
$cuil=$decoded->{'cuil'};
$localidad=$decoded->{'localidad'};
$codigo=$decoded->{'codigo'};
$aporte=$decoded->{'aporte'};
$query = "INSERT INTO aportes (nombre,domicilio,dni,telefono,email,facebook,cuil,localidad,codigo,aporte) VALUES ('$nombre','$domicio','$dni','$telefono','$email','$facebook','$cuil','$localidad','$codigo','$aporte')";
	if (@mysqli_query($con, $query)) {
		 echo "Tu aporte fue ingresado satisfactoriamente";
		 @mysql_close($con);
		 return;
		} else {
		 echo "Tu aporte no pudo ser posible, inténtalo más tarde";
		 @mysql_close($con);
		 return;
		}
}

?>