<?php

if (isset($_POST['data'])) {

$con = mysqli_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysqli_select_db( $con,"ciudadfutura");

$data = $_POST['data'];
$decoded = json_decode($data);

$ddd=$decoded->{'text'};
$secparam=$decoded->{'text2'};

$query = "INSERT INTO messages (text,segparam) VALUES ('$ddd','$secparam')";
	if (@mysqli_query($con, $query)) {
		 echo "success";
		 @mysql_close($con);
		 return;
		} else {
		 echo "save_failed";
		 @mysql_close($con);
		 return;
		}
}

?>