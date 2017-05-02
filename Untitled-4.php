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
	
	$busqueda=$_POST["searchterm"];
	$busqueda= ltrim($busqueda);
	
	
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
	
	if ($busqueda<>'')
	{ 

		//CUENTA EL NUMERO DE PALABRAS 
   		$trozos=explode(" ",$busqueda); 
		$numero=count($trozos); 

	 	if ($numero==1) 
	 	{ 
   		//SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 

			$consulta="SELECT * FROM agencias WHERE EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%'";
	
		}
		else
		{
			//$consulta="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
			//FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE )
			//ORDER BY relevancia";

			$consulta="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
			FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) HAVING relevancia > 0.2 ORDER BY relevancia DESC";

			//$consulta= "SELECT * FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE)";
			
			$num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

			

		}

		//establecemos un filtro
		
	$resulados= mysqli_query($conexion,$consulta);
	

	//$num_rows =mysqli_num_rows($resulados);
	
	//echo "$num_rows";

	
	//mira fila a fila lo que hay almacenado en cada tabla, es un array
	
	//$registros=1;
	
	//while($registros<=3){
	
	//array indexado
	//while(($fila=mysqli_fetch_row($resulados))==true){
	//while(($fila=mysqli_fetch_row($resulados))){
	
	//$fila=mysqli_fetch_row($resulados);
	
	//creamos tabla
	//echo "<table><tr><td>";

	//echo $fila[0] . "</td><td> ";
	
	//echo $fila[1]. "</td><td> ";
	
	//echo $fila[2]. "</td><td> ";
	
	//echo $fila[3]. "</td><td> ";
	
	//echo $fila[4]. "</td><td> ";
	
	//echo $fila[5]. "</td><td> ";
	
	//echo $fila[6]. "</td><td></tr></table> ";
	
	//echo "<br>";
	//echo "<br>";
	
	//$registros++;
	
	//array asociativo
	
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

	}
	else
	{

		echo ('error');
	}

?>


</body>
</html>
