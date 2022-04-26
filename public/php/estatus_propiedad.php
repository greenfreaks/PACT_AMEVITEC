<?php
	$consulta_estatus = "SELECT * FROM tec_propiedadintelectual_estatus";
	$ejecutar_estatus = mysqli_query($connection, $consulta_estatus);

	while($fila = mysqli_fetch_array($ejecutar_estatus)){
		echo "<option value = '".$fila['id_estatus']."'>".$fila['nombre_estatus']."</option>";
	}
?>