<?php

if (isset($_POST['data'])) {

$con = mysqli_connect("localhost","futura_wp","mJ4WACfnjv");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysqli_select_db( $con,"futura_wp");

$data = $_POST['data'];
$decoded = json_decode($data);

$nombre=$decoded->{'nombre'};
$domicio=$decoded->{'domicilio'};
$fecha=$decoded->{'fecha'};
$telefono=$decoded->{'telefono'};
$email=$decoded->{'email'};
$facebook=$decoded->{'facebook'};
$twitter=$decoded->{'twitter'};
$distrito=$decoded->{'distrito'};
$ocupacion=$decoded->{'ocupacion'};
$aporte=$decoded->{'aporte'};

$query = "INSERT INTO militantes (nombre,domicilio,fecha_nacimiento,telefono,email,facebook,twitter,distrito,ocupacion,aporte) VALUES ('$nombre','$domicio','$fecha','$telefono','$email','$facebook','$twitter','$distrito','$ocupacion','$aporte')";
	if (@mysqli_query($con, $query)) {
		 echo "Tu registro fue ingresado satisfactoriamente";
		 @mysql_close($con);
		 return;
		} else {
		 echo "Tu registro no pudo ser posible, inténtalo más tarde";
		 @mysql_close($con);
		 return;
		}
}

?>