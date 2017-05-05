<?php
//Archivo de conexión a la base de datos
require('datos_conexion.php');

//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";


//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

$conexion=mysqli_connect($db_host,$db_usuario,$db_contra);

if(mysqli_connect_errno())
  {
    
    echo "Fallo al conectar con la base de datos";
    
    exit();   
  }
    
  mysqli_select_db($conexion,$db_nombre)or die("no se encuentra la bdD");
  //para incluir los tildes 
  mysqli_set_charset($conexion, "utf8");  
	//Selecciona todo de la tabla mmv001 
	//donde el nombre sea igual a $consultaBusqueda, 
	//o el apellido sea igual a $consultaBusqueda, 
	//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
	
	$trozos=explode(" ",$consultaBusqueda); 
    $numero=count($trozos); 

    if ($numero==1) 
    { 

	$consulta = "SELECT * FROM agencias
	WHERE EMPRESA LIKE '%$consultaBusqueda%' 
	OR COD_AGE LIKE '%$consultaBusqueda%' OR NOM_AGE LIKE '%$consultaBusqueda%' OR NOM_AGE LIKE '%$consultaBusqueda%' OR DIR_AGE LIKE '%$consultaBusqueda%' OR EST_AGE LIKE '%$consultaBusqueda%' OR CIU_AGE LIKE '%$consultaBusqueda%' LIMIT 0,3";

	}
	else

	{	

	$consulta="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$consultaBusqueda' IN BOOLEAN MODE) as relevancia
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$consultaBusqueda' IN BOOLEAN MODE ) HAVING relevancia > 0.2 ORDER BY relevancia DESC LIMIT 0,3";
    }


	//Obtiene la cantidad de filas que hay en la consulta
	$filas = mysqli_num_rows(mysqli_query($conexion,$consulta));

	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {
		$mensaje = "<p>No hay ningún usuario con ese nombre y/o apellido</p>";
	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';

		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		$resultados= mysqli_query($conexion,$consulta);

		while($fila = mysqli_fetch_array($resultados, MYSQL_ASSOC)) 
		{

			$empresa = $fila['EMPRESA'];
			$cod_age = $fila['COD_AGE'];
			$nom_age = $fila['NOM_AGE'];
			$dir_age = $fila['DIR_AGE'];
			$est_age= $fila['EST_AGE'];
			$ciu_age= $fila['CIU_AGE'];
			//Output
			$mensaje .= '<p>' .$empresa . $cod_age . $nom_age . $dir_age . $est_age . $ciu_age. '</p><br>';

			$data[] = $fila['EMPRESA'];


		};//Fin while $resultados

	}; //Fin else $filas

};//Fin isset $consultaBusqueda



//Devolvemos el mensaje que tomará jQuery
echo $mensaje;


mysqli_close($conexion);


?>

