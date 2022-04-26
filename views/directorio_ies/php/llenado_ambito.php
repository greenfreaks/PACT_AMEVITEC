<?php
	include("conexion.php");

	$consulta_ambito = "SELECT * FROM uci_ambito";
	$ejecutarAmbito = mysqli_query($connection, $consulta_ambito);

	while($fila = mysqli_fetch_array($ejecutarAmbito)){
		echo "<option value = '".$fila['nombre_ambito']."'>".$fila['nombre_ambito']."</option>";
	} 
?>