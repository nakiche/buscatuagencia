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
			
		<div>
		 <div class="popup-heading">
		 	<h1>Oficina o sucursal</h1>

		 </div>

		 <div class="popup-body">
		  <div class="popup-body-box">	
		 	<p><span><strong> NOMBRE </strong></span></p>
		 	<p><strong>EMPRESA:</strong> TEALCA</p>
		 	<p><strong>CÓDIGO:</strong></p>
		 	<p><strong>NOMBRE: </strong> BARECELONA</p>
		 	<p><strong>TELÉFONO: </strong> 0283-23992121</p>
		 	<p><strong>DIRECCIÓN: </strong> Avenida Bolivar Edificio Arónica P.B Local 1 Secto...</p>
		 	<p><strong>ESTADO: </strong> ANZOATEGUI</p>
		 	<p><strong>CIUDAD: </strong> BARCELONA</p>
		  </div>

		  <div>
		  		<img src="images/logomrw1.png" width="98" height="43" alt="mrw">	
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
