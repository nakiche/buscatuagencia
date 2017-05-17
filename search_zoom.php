<?php

  require ("datos_conexion.php");
  
  //conexion bdd
  $conexion=mysqli_connect($db_host,$db_usuario,$db_contra);
    
  //si no llega a ejecutarse esta funcion
  if(mysqli_connect_errno())
  {
    echo "Fallo al conectar con la base de datos";
    exit();  
  }
    
  mysqli_select_db($conexion,$db_nombre)or die("no se encuentra la bdD");
  //para incluir los tildes 
  mysqli_set_charset($conexion, "utf8");  
  
  $term = trim(strip_tags($_GET['term']));
  $caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
  $caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
  $term = str_replace($caracteres_malos, $caracteres_buenos, $term);
    
  //evaluamos cuantas partes tiene la consulta   
  $trozos=explode(" ",$term); 
  $numero=count($trozos); 

  //si tiene solo una palabra hacemos la consulta sql con LIKE 
  if ($numero==1) 
  { 

  $consulta = "SELECT * FROM agencias WHERE EMPRESA = 'ZOOM' AND (EMPRESA LIKE '%$term%' 
  OR COD_AGE LIKE '%$term%' OR NOM_AGE LIKE '%$term%' OR NOM_AGE LIKE '%$term%' OR DIR_AGE LIKE '%$term%' OR EST_AGE LIKE '%$term%' OR CIU_AGE LIKE '%$term%') LIMIT 0,10";

  }
  else //si tiene mas de una palabra hacemos la consulta sql con MATCH AGAINST 
  { 

  $consulta="SELECT *, MATCH (EMPRESA,COD_AGE,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$term' IN BOOLEAN MODE) as relevancia
    FROM agencias WHERE MATCH (EMPRESA,COD_AGE,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$term' IN BOOLEAN MODE ) AND EMPRESA = 'ZOOM' HAVING relevancia > 0.2 ORDER BY relevancia DESC LIMIT 0,10";
  }    
  
  $resultado = mysqli_query($conexion, $consulta); //Ejecución de la consulta
  //Si hay resultados...
  if (mysqli_num_rows($resultado) > 0)
  { 
    while($fila = mysqli_fetch_assoc($resultado))
    { 
      // se recoge la información según la vamos a pasar a la variable de javascript
      $texto[]= $fila['EMPRESA'] . ' ' . $fila['COD_AGE'] . ' ' . $fila['NOM_AGE'] . ' ' .  $fila['EST_AGE'];
    } 
  }
  else
  { 
    $texto[] = "no se han encontrado resultados para: ". $term ;  
  }
  // Después de trabajar con la bbdd, cerramos la conexión (por seguridad, no hay que dejar conexiones abiertas)
  mysqli_close($conexion);
      
  //return $texto;  
  echo json_encode($texto);

?>

