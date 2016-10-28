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
$cbu=$decoded->{'cbu'};
$tipodecuenta=$decoded->{'tipocuenta'};
$cuenta=$decoded->{'cuenta'};
$dinero=$decoded->{'dinero'};
$numerocuenta=$decoded->{'numerocuenta'};
$query = "INSERT INTO aportes_hagamos (nombre,cbu,tipodecuenta,cuenta,dinero,numerocuenta) VALUES ('$nombre','$cbu','$tipodecuenta','$cuenta', '$dinero','$numerocuenta')";
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

if(isset($_POST['llamar'])){

	$con = mysqli_connect("localhost","futura_wp","mJ4WACfnjv");
	//$con = mysqli_connect("localhost","root","root");

	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysqli_select_db( $con,"futura_wp");
	//mysqli_select_db( $con,"ciudadfutura");

	$llamar = $_POST['llamar'];
	$decodedllamar = json_decode($llamar);
	$nombre=$decodedllamar->{'nombre'};
	$telefono=$decodedllamar->{'telefono'};
	$query = "INSERT INTO llamar_por_aportes (nombre,telefono) VALUES ('$nombre','$telefono')";
	if (@mysqli_query($con, $query)) {
		 echo "Tu aviso fue ingresado, te llamaremos a la brevedad";
		 @mysql_close($con);
		 return;
		} else {
		print_r($con);
		 echo "Tu aviso NO fue ingresado, inténtalo más tarde";
		 @mysql_close($con);
		 return;
		}

}

?>