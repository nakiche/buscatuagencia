<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Encontrar agencias oficinas agentes sucursales de envío - Buscatuagencia.com.ve</title>

  <link href="styles.css" rel="stylesheet">
<script type="text/javascript"  src="./scripts.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

</head>

<body>

     <div class="block_header">
       <div class="header">
    		 <div class="logo">
              <a href="./index.php"><img src="images/logo_tuagecia.png" width="160" height="59" border="0" alt="logo"></a>
        	 </div>
  
    
			 <form action="" method="post" onsubmit="return validacion();">
             <div class="field" id="searchform">
             	
  				<input type="text" id="searchterm" name="searchterm" placeholder="Ingrese una o más palabras relacionadas a la agencia o sucursal"  onkeypress="validacion2();" onclick="validacion2();" autocomplete="off" />
  				<button type="submit" id="search">Buscar!</button>
			</div>
			</form>
  
  	<div class="clr"></div>
		 </div>  
         <div class="clr"></div>
    	</div>
    
     
     <div class="FBG">
        <div class="FBG_resize">

          <div class="error">
          <h2 class="errortext"></h2>
          </div>

            <div class="left">
        	<h1>Filtrar por empresa de envíos:</h1>
            </div>
            <div class="clr"></div>


          
          <div class="menu">
             <ul>
            	<li><a href="mrw.html"><img src="images/logomrw.png" width="98" height="43" alt="mrw"></a> </li>
                <li><a href="zoom.html"><img src="images/logozoom.png" width="98" height="36" alt="zoom"></a> </li>
                <li><a href="domesa.html"><img src="images/logodomesa.png" width="98" height="43" alt="domesa"></a> </li>
                <li><a href="tealca.html"><img src="images/logotealca.png" width="98" height="43" alt="tealca"></a> </li>
        	                
             </ul>
            </div>
            <div class="clr"></div>
          </div>
          <div class="clr"></div>
     </div>   
      
      <div class="footer">
		<div class="footer_resize">
        
          <p class="leftt">>© Páginas web desde 2017 BUSCATUAGENCIA.COM.VE Todos los derechos reservados.<br />
          <a href="index.html"> Inicio </a> | <a href="contactar.html"> Contactar</a>| <a href="sitemap.html"> Mapa del sitio</a></p>
          
          <p class="rightt"><a href="http://www.servicio-virtual.com.ve"><strong>buscatuagencia.com.ve</strong></a></p>
          	
    </div>
    <div class="clr"></div>
  </div>
 	<div class="clr"></div>
    
    
<?php

  if (isset($_POST["searchterm"]))
  {  
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

       $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {

        ?>
        <script language="javascript"> 
             
                validacion3(); 
          </script> 


        <?php

      }
  
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

      if($num_rows==0)
      {

        ?>
        <script language="javascript"> 
             
                validacion3(); 
          </script> 


        <?php

      }
      

      

    }

    //establecemos un filtro
    
  $resulados= mysqli_query($conexion,$consulta);
   
    if($num_rows>0)
      {
    echo "<table class='tabla'><tr>";

    echo "<th>Empresa</th>";
  
    echo "<th>Código</th>";
  
    echo "<th>Nombre</th>";
  
    echo "<th>Teléfono</th>";
  
    echo "<th>Horario</th>";
  
    echo "<th>Dirección</th>";
  
    echo "<th>Empresa</th>";
  
    echo "<th>Ciudad</th></tr>";
    
    
      }
  while($fila=mysqli_fetch_array($resulados, MYSQL_ASSOC))

    
    
  {
  //while($fila=mysqli_fetch_object($resulados)){ 
    
    echo "<tr>";

    echo "<td>".$fila['EMPRESA']. "</td>";
  
    echo "<td>".$fila['COD_AGE']. "</td>";
  
    echo "<td>".$fila['NOM_AGE']. "</td>";
  
    echo "<td>".$fila['TEL_AGE']. "</td>";
  
    echo "<td>".$fila['HOR_AGE']. "</td>";
  
    echo "<td>".$fila['DIR_AGE']. "</td>";
  
    echo "<td>".$fila['EST_AGE']. "</td>";

    echo "<td>".$fila['CIU_AGE']. "</td></tr>";    
  
  
  }

  echo "</table>";

  //cerramos la conexiòn
  mysqli_close($conexion);

  }
  else
  {

    echo ('error');
  }

}
?>

</body>


</html>

