<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Encontrar agencias oficinas agentes sucursales de envío - Buscatuagencia.com.ve</title>

<link href="styles.css" rel="stylesheet">
<script type="text/javascript"  src="./scripts.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> -->


<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  
$(function() {
   //autocomplete
   $("#searchterm").autocomplete({
    
    source: "search.php",
        minLength: 1
   });              
});

  
</script>

</head>

<body>
 <div class="main"> 
  
  <div class="block_header">
    
    <div class="header">
    		<div class="logo">
          <a href="./index.php"><img src="images/logo_tuagecia.png" width="160" height="59" border="0" alt="logo"></a>
        </div>
  

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" onsubmit="return validacion();">
    
    <div class="ui-widget" id="field">
         <!-- <label for="tags">Tags: </label> -->
         <!-- <input type="text" id="tags"> -->
      <input type="text" id="searchterm" name="searchterm" placeholder="Ingrese una o más palabras relacionadas a la agencia o sucursal" onkeyup="buscar();" onkeypress="validacion2();" onclick="validacion2()"; >
      <button type="submit" id="search">Buscar!</button>
       <!-- <input id="tags"> -->
    </div>

	</form>


    	 <!-- <form action="" method="post" onsubmit="return validacion();">
             <div class="field" id="searchform"> -->
             	
  				<!-- <input type="text" id="searchterm" name="searchterm" placeholder="Ingrese una o más palabras relacionadas a la agencia o sucursal" onkeypress="validacion2();" onclick="validacion2();" autocomplete="off" /> -->
          
          
            <!-- <input type="text" id="searchterm" name="searchterm" placeholder="Ingrese una o más palabras relacionadas a la agencia o sucursal" onkeyup="buscar();" onkeypress="validacion2();" onclick="validacion2()"; autocomplete="off" />
        
          
  				<button type="submit" id="search">Buscar!</button>

			       </div>
			</form>

         -->
   

<div class="FBG">
    <div class="FBG_resize">

        <!-- Mensaje de la busqueda instantanea con jquery-->
        <div id="resultadoBusqueda"></div>

          <!-- Mensajes de error -->
        <div class="error">
        <h2 class="errortext"></h2>
        </div>

        <div class="left">
        <h1>Búsqueda por empresa de envíos:</h1>
        </div>
        <div class="clr"></div>
          
        <div class="menu">
          <ul>
          
            <li><a href="mrw.html"><img src="images/logomrw.png" width="98" height="43" alt="mrw"></a></li>
            <li><a href="zoom.html"><img src="images/logozoom.png" width="98" height="36" alt="zoom"></a></li>
            <li><a href="domesa.html"><img src="images/logodomesa.png" width="98" height="43" alt="domesa"></a></li>
            <li><a href="tealca.html"><img src="images/logotealca.png" width="98" height="43" alt="tealca"></a></li>

                                  
          </ul>
       </div>

          <div class="clr"></div>
    </div>  
          <div class="clr"></div>
</div>


        <!-- <div class="left2">
        <h1>Filtrar resultado por empresa de envíos:</h1>
        </div>
        <div class="clr"></div>

        <div class="menu2">
          <ul>
          
            <li><a href="mrw.html"><img src="images/logomrw.png" width="98" height="43" alt="mrw"></a></li>
            <li><a href="zoom.html"><img src="images/logozoom.png" width="98" height="36" alt="zoom"></a></li>
            <li><a href="domesa.html"><img src="images/logodomesa.png" width="98" height="43" alt="domesa"></a></li>
            <li><a href="tealca.html"><img src="images/logotealca.png" width="98" height="43" alt="tealca"></a></li>

           
                          
          </ul>
        </div>-->

    

 
    <div class="clr"></div>
  </div>
    <div class="clr"></div>
</div> 
    
    
  
  
      
<?php

//prevent sql inyection
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if (isset($_GET["searchterm"]))
{  
  
  ?>
    <!-- <script language="javascript"> 
     hide(); 
    </script>  -->
  <?php

  $busqueda = test_input($_GET["searchterm"]);
  
    //$busqueda=$_GET["searchterm"];
    //$busqueda= ltrim($busqueda);
  
    
    //usamos la conexion desde otro archivo
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

    //Paginación
    $tamano_paginas=3;

    if(isset($_GET["pagina"]))
    {
      
     $pagina=$_GET["pagina"];      
     
    }
    else
    {
      $pagina=1;
    }

  //si existe algo en la busqueda 
    if ($busqueda<>'')
    { 
    //CUENTA EL NUMERO DE PALABRAS 
      $trozos=explode(" ",$busqueda); 
      $numero=count($trozos); 

    //$reg_query="SELECT * FROM agencias WHERE EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%' LIMIT 0,80" ; 
    //Paginación    
    if ($numero==1) 
    { 
      //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 
      //$sql_total= $reg_query; // query en forma de variable
    $sql_total="SELECT * FROM agencias WHERE EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%' LIMIT 0,80";

       $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));      
    }
    else
    {  
     $sql_total="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) LIMIT 0,80";
    }  
      $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));


    //paginación  
    $total_paginas=ceil($num_rows_total/$tamano_paginas);

    $empezar_desde=($pagina-1)*$tamano_paginas; 



    //consulta segun numero de palabras

    if ($numero==1) 
    { 
      //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 

      $consulta="SELECT * FROM agencias WHERE EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%' LIMIT $empezar_desde,$tamano_paginas";

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
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) HAVING relevancia > 0.2 ORDER BY relevancia DESC LIMIT $empezar_desde,$tamano_paginas";

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
    
      
    $resulados= mysqli_query($conexion,$consulta);
   
    if($num_rows>0)
    {
    //haciendo la tabla responsive  
      ?>    
      <div class= "tabla">    
        
      <?php
        
        echo "<p>Cerca de: $num_rows_total resultados</p>" ; //paginación

        echo "<table class='tabla'><tr>";      //creamos la tabla
        echo "<th>Empresa</th>";
        echo "<th>Código</th>";
        echo "<th>Nombre</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Horario</th>";
        echo "<th>Dirección</th>";
        echo "<th>Estado</th>";
        echo "<th>Ciudad</th></tr>";

    }

    while($fila=mysqli_fetch_array($resulados, MYSQL_ASSOC))    
    {

      echo "<tr>";                              //llenamos la tabla

      // echo "<td>".$fila['COD_INT']. "</td>";
      echo "<td>".$fila['EMPRESA']. "</td>";
      echo "<td class='centered'>".$fila['COD_AGE']."<br><a href='untitled-4.php?cod_int=".$fila['COD_INT']."' onclick='popupwindow();' target='pop'>Ver agencia</a></td>";
      echo "<td>".$fila['NOM_AGE']. "</td>";
      echo "<td>".$fila['TEL_AGE']. "</td>";
      echo "<td>".$fila['HOR_AGE']. "</td>";
      echo "<td>".$fila['DIR_AGE']. "</td>";
      echo "<td>".$fila['EST_AGE']. "</td>";
      echo "<td>".$fila['CIU_AGE']. "</td></tr>";    
   }

      echo "</table>";                            //cerramos la tabla

     

    //-------------------paginacion

    //muestro los distintos índices de las páginas, si es que hay varias páginas 
    if ($total_paginas > 1)
    { 
      
       ?>

       <div class="pagination">        
       <?php 

       echo "<p>Página $pagina  de  $total_paginas </p>";
       
       

       if ($pagina !=1)
       {
          echo "<a href='index.php?searchterm=$busqueda&pagina=".($pagina-1)."'><img src='images/izq.gif' border='0'></a>";
       }                                                     

      for ($i=1;$i<=$total_paginas;$i++)
      { 
        if ($pagina == $i) 
          //si muestro el índice de la página actual, no coloco enlace 
      

          echo "<span>$pagina</span>"; 
        else 
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
          //echo "<a href='index.php?pagina=" . $i . "&criterio=" . $txt_criterio . "'>" . $i . "</a> "; 

          echo "<a href='index.php?searchterm=$busqueda&pagina=$i'>  $i </a>";
      }

      if ($pagina !=$total_paginas)
       {
          echo "<a href='index.php?searchterm=$busqueda&pagina=".($pagina+1)."'><img src='images/der.gif' border='0'></a>";
       }      


    }
       ?>
       </div> 
    </div>
       <?php


       

    //cerramos la conexiòn
    mysqli_close($conexion);

  }
  else
  {

    echo ('error'); //fin del if $busqueda <> ""
  }

} //isset
//else 
//{
  ?>
    <!-- <script language="javascript"> 
     show(); 
    </script>  -->
  <?php

//} 

?>

 <div class="footer">
    <div class="footer_resize">
        
          <p class="leftt">>© Páginas web desde 2017 BUSCATUAGENCIA.COM.VE Todos los derechos reservados.<br />
          <a href="index.php"> Inicio </a> | <a href="contactar.html"> Contactar</a>| <a href="sitemap.html"> Mapa del sitio</a></p>
          
          <p class="rightt"><a href="http://www.servicio-virtual.com.ve"><span>buscatuagencia.com.ve</span></a></p>
            
    </div>
     <div class="clr"></div>
  </div>
    <div class="clr"></div>
 
 </div>

</body>


</html>

