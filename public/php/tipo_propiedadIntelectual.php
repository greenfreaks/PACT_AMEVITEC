<?php
	$consulta_tipoPropiedadIntelectual = "SELECT * FROM tec_tipopropiedadintelectual";
	$ejecutarTipoPropiedadIntelectual = mysqli_query($connection, $consulta_tipoPropiedadIntelectual);

	while($fila = mysqli_fetch_array($ejecutarTipoPropiedadIntelectual)){
		echo "<option value = '".$fila['id_tipoPropiedadIntelectual']."'>".$fila['nombre_tipoPropiedadIntelectual']."</option>";
	}
?>