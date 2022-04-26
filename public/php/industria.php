<?php
	$consulta_industria = "SELECT * FROM uci_industria_labs";
	$ejecutarIndustria = mysqli_query($connection, $consulta_industria);

	while($fila = mysqli_fetch_array($ejecutarIndustria)){
		echo "<option value = '".$fila['id_industria']."'>".$fila['nombre_industria']."</option>";
	}

/*
	include("con_db.php");

	$consulta_industria = "SELECT * FROM uci_industria_labs";
	$ejecutarIndustria = mysqli_query($conex, $consulta_industria);

	while($fila = mysqli_fetch_array($ejecutarIndustria)){
        ?>
        <p>
                <label>
                    <input name="ch_industria[]" value = <?php echo $fila["id"];?> type='checkbox'/>
                    <span><?php echo $fila["nombre_scian"];?></span>
                </label>
            </p>
                <?php
	}*/

    
?>