<?php 

	include('conexao.php');	
	$id = $_GET['id'];


	$query = "DELETE FROM config WHERE id_config = '$id'";
	$exec_query = $mysqli->query($query) or die($mysqli->error);

	if($exec_query)
		echo "<script>location.href='listaAgenda.php';</script>";
	else
		echo "<script>location.href='listaAgenda.php';</script>";
?>