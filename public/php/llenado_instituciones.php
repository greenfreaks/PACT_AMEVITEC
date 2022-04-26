<?php

	$consulta_instituciones = "SELECT * FROM uci_instituciones";
	$ejecutarInstituciones = mysqli_query($connection, $consulta_instituciones);

	while($fila = mysqli_fetch_array($ejecutarInstituciones)){
		echo "<option value = '".$fila['id_institucion']."'>".$fila['nombre_institucion']."</option>";
	}
?>