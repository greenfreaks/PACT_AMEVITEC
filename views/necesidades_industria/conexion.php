<?php
	$host = 'localhost';
	$user = 'tecnotr1_pact_manager';
	$password = 'e?)ds$B^BE=#';
	$db = 'tecnotr1_pact';

	$connection = @mysqli_connect($host, $user, $password, $db);
	if(!$connection){
		echo "Error en la conexión";
	}
	$connection -> set_charset("utf8");
?>