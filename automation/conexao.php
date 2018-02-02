<?php 
	$host = '127.0.0.1';
	$usuario = 'root';
	$senha = 'omega123';
	$db   = 'tcc';

	$mysqli = new mysqli($host,$usuario,$senha,$db);

	if($mysqli->connect_errno)
		echo "Falha na conexao";
?>