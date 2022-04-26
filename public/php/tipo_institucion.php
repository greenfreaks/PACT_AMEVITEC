<?php
	$consulta_tipo_institucion = "SELECT * FROM uci_tipo_institucion";
	$ejecutarTipoInstitucion = mysqli_query($connection, $consulta_tipo_institucion);

	while($fila = mysqli_fetch_array($ejecutarTipoInstitucion)){
		echo "<option value = '".$fila['id_tipo_institucion']."'>".$fila['tipo_institucion']."</option>";
	}
?>