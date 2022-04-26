<?php
	include("conexion.php");

	$consulta_funcion = "SELECT * FROM funcion_academico";
	$ejecutarFuncion = mysqli_query($connection, $consulta_funcion);

	while($fila = mysqli_fetch_array($ejecutarFuncion)){
		echo "<option value = '".$fila['funcion_academico']."'>".$fila['funcion_academico']."</option>";
	}
?>