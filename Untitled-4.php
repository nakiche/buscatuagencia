<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
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
		
		echo "<table><tr><td>";

		echo $fila["EMPRESA"] . "</td><td> ";
	
		echo $fila["COD_AGE"]. "</td><td> ";
	
		echo $fila["NOM_AGE"]. "</td><td> ";
	
		echo $fila["TEL_AGE"]. "</td><td> ";
	
		echo $fila["HOR_AGE"]. "</td><td> ";
	
		echo $fila["DIR_AGE"]. "</td><td> ";
	
		echo $fila["EST_AGE"]. "</td><td> ";
	
		echo $fila["CIU_AGE"]. "</td><td></tr></table> ";
		
		echo "<br>";
		echo "<br>";
	
	
	}

	//cerramos la conexiòn
	mysqli_close($conexion);

	
?>


</body>
</html>
