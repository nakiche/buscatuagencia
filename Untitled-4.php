<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agencias y sucursales de envío</title>
<link href="styles.css" rel="stylesheet">
<script type="text/javascript"  src="./scripts.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>


</head>

<body>

<?php
	
	$busqueda=$_GET["cod_int"];
	
	//usamos la conexion desde otro archivo
	require ("datos_conexion.php");
	
	//conexion en programacion orientado a obtejo
	//$conexion=mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);
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
	
	
   		//SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 

	$consulta="SELECT * FROM agencias WHERE  COD_INT = $busqueda";
	
		
		//establecemos un filtro
		
	$resulados= mysqli_query($conexion,$consulta);
	

		
	while($fila=mysqli_fetch_array($resulados, MYSQL_ASSOC))
	{
	//while($fila=mysqli_fetch_object($resulados)){	
		?>
			
		<div class="main-popup">

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

		  		<div class="popup-body-box">
		  			<img src="images/<?php echo $fila['IMG_AGE']?>" width="440" height="250" alt="Logo">	
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
