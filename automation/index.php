<?php 
include('conexao.php');

$consulta = "SELECT id_device, ds_bit, nm_device, ds_pino FROM device";
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
			  <h1>Gerenciar Dispositivos</h1>
			</div>
			<div class="btn-group">
			  <a href="listaAgenda.php" class="btn btn-primary btn-padrao">Listar Agenda</a>
			</div>
			<div class="row">

			<?php while($dado = $con->fetch_array()) { ?>
				<?php exec('python /home/pi/GPIO/automate.py '.$dado["ds_pino"].' '.$dado["ds_bit"]); ?>

				<div class="col-md-4 col-sm-4">
					<div class="panel">
						<div class="panel-title">
							<h2><?php echo $dado["nm_device"]; ?></h2>
							<div class="button-device">							
								<input type="checkbox" id="<?php echo $dado["id_device"].$dado["ds_pino"]; ?>" data-toggle="toggle" data-onstyle="success">
							</div>
						
						</div>
<form method="post" id="device-<?php echo $dado["id_device"]; ?>">
						<div class="panel-content">
							<label class="form-label">AGENDAR DISPOSITIVO</label>
							
							<div class="form-group">
							  <label class="form-label" for="sel1">Definir ação</label>
							  <select class="form-control" name="acao">
							  <option>-- Escolher --</option>
							  <option value="1">liga</option>
							  <option value="0">desliga</option>
							  </select>
							</div>	

				            <div class="form-group">
						<label class="form-label">Definir data e hora</label>
				                <div class='input-group date' id='datetimepicker-<?php echo $dado["id_device"]; ?>'>
				                    <input type='text' name="data" class="form-control" />
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
				            </div>
						<input type="hidden" name="id" value="<?php echo $dado["id_device"]; ?>">
				            <div class="btn-group">
							  <button type="submit" class="btn btn-primary btn-padrao">Salvar</button>
						  	</div>

</form>
					</div>

					</div>
				</div>

			<?php }?>

	
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

						var estadoDevice = value.ds_bit;
						if(estadoDevice == '1')
						{
							$('#' + value.id_device+value.ds_pino).bootstrapToggle('on');
						}else{
							$('#' + value.id_device+value.ds_pino).bootstrapToggle('off');
						}
						

		
				    		$('#' + value.id_device+value.ds_pino).change(function(e) {

							var bit = $(this).prop('checked') ? 1 : 0;							
							var pino = value.ds_pino;
							var id = value.id_device;						

				  			$.ajax({
								    type: "POST",
								    url: "intermediate.php",
								    data: { bit :bit, pino:pino, id:id}, 
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