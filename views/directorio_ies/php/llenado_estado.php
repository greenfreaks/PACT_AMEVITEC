<?php
	include("conexion.php");

	$consulta_estado= "SELECT * FROM estado";
	$ejecutarEstado = mysqli_query($connection, $consulta_estado);

	while($fila = mysqli_fetch_array($ejecutarEstado)){
		echo "<option value = '".$fila['estado']."'>".$fila['estado']."</option>";
	}
?>