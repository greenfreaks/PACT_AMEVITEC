<?php
	$host = 'localhost';
	#$user = 'tecnotr1_webmstr';
	#$password = 'Oa?*&2#Bzuqt';
	$user = 'root';
	$password = '';
	$db = 'tecnotr1_bd_tbr_plataforma';

	$connection = @mysqli_connect($host, $user, $password, $db);
	if(!$connection){
		echo "Error en la conexión";
	}/*else{
		echo "Conexión exitosa";
	}*/
	$connection -> set_charset("utf8");
?>