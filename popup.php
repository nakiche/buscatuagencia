<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agencias y sucursales de envío</title>
<meta property="og:image" content="https://s4.postimg.org/utfq069a5/opimage.png"/>
<meta property="og:image:width" content="1500" /> 
<meta property="og:image:height" content="574" />
<meta name="description" content="Encuetra tu agencia o sucursal de envío en Venezuela"/>
<meta name="keywords" content="Agencias de envío, sucursales de envío, oficinas de envío, Mrw, Zoom, Domesa, Tealca, encuentra tu agencia, Venezuela"/>
<link href='images/favicon.ico' rel='shortcut icon' type='image/png'>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="popup_styles.css" rel="stylesheet">
<style type="text/css">	
</style>
</head>
<body>

<?php
	
	$busqueda=$_GET["cod_int"];
	//usamos la conexion desde otro archivo
	require ("datos_conexion.php");
	//conexion en programacion orientado a obtejo
	$conexion=mysqli_connect($db_host,$db_usuario,$db_contra);	
	//si llega a ejecutarse esta funcion
	if(mysqli_connect_errno())
	{
		echo "Fallo al conectar con la base de datos";
		exit();		
	}
		
	mysqli_select_db($conexion,$db_nombre)or die("no se encuentra la bdD");
	//para incluir los tildes	
	mysqli_set_charset($conexion, "utf8");	

	$consulta="SELECT * FROM agencias WHERE  COD_INT = $busqueda";
	//establecemos un filtro
	$resulados= mysqli_query($conexion,$consulta);	
	while($fila=mysqli_fetch_array($resulados, MYSQL_ASSOC))
	{
		?>		
		<div class="main-container">
		 	<div class="popup-heading">
		 		<h1>Oficina o sucursal</h1>
		 	</div>
		 	
		 	<div class="popup-body">
		 	
		  		<div class="popup-body-box">	
		 			<span><strong><?php echo $fila['NOM_AGE']?></strong></span>
		 			<p><strong>EMPRESA: </strong><?php echo $fila['EMPRESA']?></p>
		 			<p><strong>CÓDIGO: </strong><?php echo $fila['COD_AGE']?></p>
		 			<p><strong>TELÉFONO: </strong><?php echo $fila['TEL_AGE']?></p>
		 			<p><strong>HORARIO: </strong><?php echo $fila['HOR_AGE']?></p>
		 			<p><strong>DIRECCIÓN: </strong><?php echo $fila['DIR_AGE']?></p>
		 			<p><strong>ESTADO: </strong><?php echo $fila['EST_AGE']?></p>
		 			<p><strong>CIUDAD: </strong><?php echo $fila['CIU_AGE']?></p>
		  		</div>

		  		<div class="popup-body-box2">
		  			<img src="images/<?php echo $fila['IMG_AGE']?>" alt="Logo">	
		  		</div>

			</div>	

		</div>
	 
		<?php
	}

	//cerramos la conexiòn
	mysqli_close($conexion);
	
?>

</body>
</html>
