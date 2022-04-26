<?php
	include("conexion.php");

	$consulta_industria = "SELECT * FROM uci_industria_labs";
	$ejecutarIndustria = mysqli_query($connection, $consulta_industria);

	while($fila = mysqli_fetch_array($ejecutarIndustria)){
		echo "<option value = '".$fila['nombre_industria']."'>".$fila['nombre_industria']."</option>";
	}
?>