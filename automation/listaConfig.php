<?php 
include('conexao.php');

$consulta = "SELECT  c.id_config, c.id_device, d.nm_device, c.ds_acao, c.dt_config FROM config c join device d on d.id_device = c.id_device WHERE c.dt_config > DATE_FORMAT(NOW(),'%Y/%m/%d %H:%i') ORDER BY c.dt_config";
$con = $mysqli->query($consulta);

?>


<!DOCTYPE html>
<html>
<head>
	<script> if (window.location.href.indexOf('minhur.github.io') > 0) window.location.replace('http://www.bootstraptoggle.com') </script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msvalidate.01" content="3638AEFC99423BA5CB586805286C39AA" />
	<meta name="description" content="Bootstrap Toggle is a highly flexible Bootstrap plugin that converts checkboxes into toggles." />
	<meta name="keywords" content="bootstrap, toggle, switch, bootstrap-toggle, bootstrap-switch" />
	<meta name="author" content="metatags generator">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 month">
	<title>Bootstrap Toggle</title>
	<link rel="canonical" href="http://www.bootstraptoggle.com">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/styles/github.min.css" rel="stylesheet" >
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap-toggle.css" rel="stylesheet">
	<link href="doc/stylesheet.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body>
	<header>
		
	</header>

	<main>
		<div id="usage" class="container">			
		<a href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Voltar</a>
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
					<td><a href="excluiConfig.php?id=<?php echo $dado["id_config"]; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></>
					
					</td>
				    </tr>
				<?php }?>				
				  </tbody>
			</table>
		</div>


	</main>
	<footer>
	</footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/highlight.min.js"></script>
	<script src="doc/script.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="js/bootstrap-toggle.js"></script>
	<script>
		
		$.getJSON("getDevice.php", function(data){
		    $.each(data, function (index, value) {

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