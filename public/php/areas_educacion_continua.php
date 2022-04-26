<?php


	$consulta_areas_educacion_continua = "SELECT * FROM uci_areas_educacion_continua";
	$ejecutarAreasEducacionContinua = mysqli_query($connection, $consulta_areas_educacion_continua);

	while($fila = mysqli_fetch_array($ejecutarAreasEducacionContinua)){
		echo "<p>
		<label>
			<input type='checkbox' class='educacion_continua' name='areas_educacion_continua[]' value='".$fila['id_area_educacion_continua']."'/>
			<span>".$fila['nombre_area_educacion_continua']."</span>
		</label>
	</p>";
	}
?>