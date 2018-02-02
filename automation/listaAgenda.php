<?php 
include('conexao.php');

$consulta = "SELECT  c.id_config, c.id_device, d.nm_device, c.ds_acao, c.dt_config FROM config c join device d on d.id_device = c.id_device WHERE c.dt_config > DATE_FORMAT(NOW(),'%Y/%m/%d %H:%i') ORDER BY c.dt_config";
$con = $mysqli->query($consulta);

?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Automação residencial</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

	<!-- checkbox com toggle on off -->
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

	<!-- datetimepicker -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">


	<link rel="stylesheet" type="text/css" href="css/styles.css">	
</head>
<body>


	<div class="page-content">
		<div class="container">
			<div class="page-header">
			  <h1>Dispositivos Agendados</h1>
		</div>	
			<div class="btn-group">
			  <a href="index.php" class="btn btn-primary btn-padrao">Voltar</a>
			</div>
		<div class="row">

				<table class="table">
				  <thead class=thead-dark>
				    <tr>				      
				      <th scope="col">Device</th>
				      <th scope="col">Data programada</th>
				      <th scope="col">Ação</th>
					<th scope="col">Deletar</th>
				    </tr>
				  </thead>
				  <tbody>
				<?php while($dado = $con->fetch_array()) { ?>
				    <tr>			
				      <td><?php echo $dado["nm_device"]; ?></td>
				      <td><?php echo $dado["dt_config"]; ?></td>
				      <td><?php 
						if($dado["ds_acao"] == "1") 
							echo "Ligar"; 
						else 
							echo "Desligar";
					  ?></td>
					<td><a href="javascript:if(confirm('Deseja realmente excluir?'))location.href='excluiConfig.php?id=<?php echo $dado["id_config"]; ?>';"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></>
					
					</td>
				    </tr>
				<?php }?>				
				  </tbody>
			</table>

	
		</div>


	</div>
	

	<script type="text/javascript" src="js/jquery-3.2.1.min.js">		</script>
	<script type="text/javascript" src="js/bootstrap.min.js">		</script>
	<!-- toggle dos checkbox -->
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<!-- datetimepicker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


	<script>
moment.locale('pt-BR');
    	moment().format('MMMM D YYYY, h:mm:ss');
	
        

	$.getJSON("getDevice.php", function(data){
		    $.each(data, function (index, value) {
				$('#datetimepicker-' + value.id_device).datetimepicker();

				$(function() {
				    		$('#' + value.id_device+value.ds_pino).change(function(e) {

							var bit = $(this).prop('checked') ? 1 : 0;							
							var pino = value.ds_pino;						

				  			$.ajax({
								    type: "POST",
								    url: "intermediate.php",
								    data: { bit : bit, pino: pino}, 
								    success: function(){			        
								    }
								  });
				    		})


						$('#device-' + value.id_device).submit(function(e) {
							var dados = jQuery(this).serialize();

				  			$.ajax({
								    type: "POST",
								    url: "setConfig.php",
								    data: dados, 
								    success: function(){			        
									alert("Dados salvos com sucesso!");
								    }
								  });

							return false;
							e.prevetDefault();
				    		})

				})
		        
	   	 	});
		});



	</script>

</body>
</html>