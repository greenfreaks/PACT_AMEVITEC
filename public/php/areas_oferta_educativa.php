<?php


	$consulta_areas_oferta_educativa = "SELECT * FROM uci_areas_oferta_educativa";
	$ejecutarAreasOfertaEducativa = mysqli_query($connection, $consulta_areas_oferta_educativa);

	while($fila = mysqli_fetch_array($ejecutarAreasOfertaEducativa)){
		echo "<p>
		<label>
			<input type='checkbox' class='oferta_educativa' name='areas_oferta_educativa[]' value='".$fila['id_area_oferta']."'/>
			<span>".$fila['nombre_area_oferta']."</span>
		</label>
	</p>";
	}
?>