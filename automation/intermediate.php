<?php

	include('conexao.php');	

	$id = $_POST['id'];
	$pino = $_POST['pino'];
	
	if($_POST['bit'] == '1')
	{
	     	exec('python /home/pi/GPIO/automate.py '.$pino.' 1');

		$query = "UPDATE device SET ds_bit = '1' WHERE id_device = '$id'";
		$exec_query = $mysqli->query($query) or die($mysqli->error);
		
	}
	
	if($_POST['bit'] == '0')
	{
	     	exec('python /home/pi/GPIO/automate.py '.$pino.' 0');

		$query = "UPDATE device SET ds_bit = '0' WHERE id_device = '$id'";
		$exec_query = $mysqli->query($query) or die($mysqli->error);
		
	}
?>