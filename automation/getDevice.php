<?php 
include('conexao.php');

$consulta = "SELECT id_device, ds_bit, ds_pino FROM device";
$con = $mysqli->query($consulta);


$rows = array();
while($r = mysqli_fetch_assoc($con)) {
    $rows[] = $r;
}
print json_encode($rows);


?>