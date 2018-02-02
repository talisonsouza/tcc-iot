<?php 
include('conexao.php');

date_default_timezone_set('America/Sao_Paulo');

$id_device = $_POST['id'];
$acao = $_POST['acao'];
$data = $_POST['data'];



$newdt = date("Y-m-d H:i:s", strtotime($data));

$newdt = "'".$newdt."'";

$acao = "'".$acao."'";


$query = "INSERT INTO config(id_device, ds_acao, dt_config) VALUES($id_device,$acao,$newdt)";

echo $query;

$save = $mysqli->query($query);

if($save)
{
	echo "true";
}

?>