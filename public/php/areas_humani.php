<?php
	$consulta_areas_conocimiento = "SELECT * FROM uci_areas_conocimiento WHERE fk_ambito = 3";
	$ejecutarAreasConocimiento = mysqli_query($connection, $consulta_areas_conocimiento);

	while($fila = mysqli_fetch_array($ejecutarAreasConocimiento)){
		echo "<option value = '".$fila['id_area_conocimiento']."'>".$fila['nombre_area_conocimiento']."</option>";
	}
?>