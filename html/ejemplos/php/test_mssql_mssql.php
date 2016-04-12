<?php

// Se realiza la conexón con los datos especificados anteriormente
$conn = mssql_connect( '.', '', '' );
mssql_select_db( 'testconndb');

if (!$conn)
  	{
  		exit( "Error al conectar: " . $conn);
	}

// Se define la consulta que va a ejecutarse
$sql = "SELECT * FROM Tabla";

// Se ejecuta la consulta y se guardan los resultados en el recordset rs
$rs = mssql_query( $sql );

if ( !$rs )
{
	exit( "Error en la consulta SQL" );
}
// Se muestran los resultados
$resultado=mssql_result($rs, 0,"Campo");
echo $resultado;

// Se cierra la conexión
mssql_close( $conn );
?>