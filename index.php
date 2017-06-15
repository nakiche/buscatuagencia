<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Encontrar agencias oficinas sucursales de envío - Buscatuagencia.com.ve</title>
<meta property="og:image" content="https://s4.postimg.org/utfq069a5/opimage.png"/>
<meta property="og:image:width" content="1500" /> 
<meta property="og:image:height" content="574" />
<meta name="description" content="Encuetra tu agencia o sucursal de envío en Venezuela"/>
<meta name="keywords" content="Agencias de envío, sucursales de envío, oficinas de envío, Mrw, Zoom, Domesa, Tealca, encuentra tu agencia, Venezuela"/>
<link href='images/favicon.ico' rel='shortcut icon' type='image/png'>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="styles.css" rel="stylesheet">
<link href="fonts.css" rel="stylesheet">  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="scripts.js" type="text/javascript"></script>

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
        <a href="./index.php"><img src="images/logo_tuagecia.png" border="0" alt="logo"></a>
      </div>
  
      <div class="entrada">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" onsubmit="return validacion();">
          <div class="ui-widget" id="field">
           <input type="text" id="searchterm" name="searchterm" placeholder="Ingrese una o más palabras relacionadas a la agencia o sucursal"  onkeypress="validacion2();" onclick="validacion2()";>
           <button type="submit" id="search">Buscar!</button>
          </div>
	      </form>
      </div>

    </div> 
  </div>

  <div class="FBG">
    <div class="FBG_resize">

      <div class="error">
        <h2 class="errortext"></h2>
      </div>
        
      <div class="clr"></div>

      <div class="left">
        <h1>Buscar por empresa de envíos:</h1>
      </div>
      <div class="clr"></div>

      <div class="menu">
        <ul>         
          <li><a href="mrw.php"><img src="images/logomrw.png"  alt="mrw"></a></li>
          <li><a href="zoom.php"><img src="images/logozoom.png"  alt="zoom"></a></li>
          <li><a href="domesa.php"><img src="images/logodomesa.png"  alt="domesa"></a></li>
          <li><a href="tealca.php"><img src="images/logotealca.png"  alt="tealca"></a></li> 
        </ul>
      </div>

      <div class="left2">
        <h1>Filtrar el resultado por empresa de envíos:</h1>
      </div>
      <div class="clr"></div>

      <?php
        $termino="";
        if (isset($_GET["searchterm"]))
        {                               //capturamos la frase de busqueda para enviarla en el filtro
          $termino=$_GET["searchterm"];
        } 
      ?>  
      
      <div class="menu2">
        <ul>
          <li><a href='index.php?filtro=MRW&searchterm=<?php echo $termino;?>'><img src="images/logomrw.png"  alt="mrw"></a></li>
          <li><a href='index.php?filtro=ZOOM&searchterm=<?php echo $termino;?>'><img src="images/logozoom.png"  alt="zoom"></a></li>
          <li><a href='index.php?filtro=DOMESA&searchterm=<?php echo $termino;?>'><img src="images/logodomesa.png"  alt="domesa"></a></li>
          <li><a href='index.php?filtro=TEALCA&searchterm=<?php echo $termino;?>'><img src="images/logotealca.png"  alt="tealca"></a></li>       
        </ul>
      </div>
    
    </div>
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
    <script language="javascript"> 
      hide(); //ocultamos el menu
    </script> 
  <?php   

  $busqueda = test_input($_GET["searchterm"]);

  $trozos=explode(" ",$busqueda); 
  $numero=count($trozos); 
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
     
  if(!empty($_GET["filtro"]))  /*valido si me estan mandando un filtro*/
    {
      $filtro=$_GET['filtro']; 

      switch($_GET["filtro"]) 
      {
        case "MRW":
          
      if ($numero==1) 
      {//SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE     
        $sql_total="SELECT * FROM agencias WHERE EMPRESA = 'MRW' AND (EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%') LIMIT 0,80";
        $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));      
      }
      else
      { //SI HAY MÁS DE DOS PALABRAS BUSCAMOS CON MATCH AGAINST       
        $sql_total="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE)
        FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) AND EMPRESA = 'MRW' LIMIT 0,80";
        $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));
      }  
      
      $tamano_paginas=3; //Paginación

      if(isset($_GET["pagina"]))
      {
      
        $pagina=$_GET["pagina"];      
     
      }
      else
      {
        $pagina=1;
      }    
     
      $total_paginas=ceil($num_rows_total/$tamano_paginas); //redodeamos el total de páginas

      $empezar_desde=($pagina-1)*$tamano_paginas;
      //consulta segun numero de palabras
      if ($numero==1) 
      { //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 

        $consulta="SELECT * FROM agencias WHERE EMPRESA = 'MRW' AND (EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%') LIMIT $empezar_desde,$tamano_paginas";

        $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //mensaje de error si no hay coincidencias
          </script> 
        <?php
      }
  
    }
    else
    {
      $consulta="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) AND EMPRESA = 'MRW' HAVING relevancia > 0.2 ORDER BY relevancia DESC LIMIT $empezar_desde,$tamano_paginas";

      $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //mensaje de error si no hay coincidencias
          </script> 

        <?php
      }    
    }     

    break;
    
    case "ZOOM":

    if ($numero==1) 
      { //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 
            
        $sql_total="SELECT * FROM agencias WHERE EMPRESA = 'ZOOM' AND (EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%') LIMIT 0,80";

        $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));      
      }
      else
      { //HAY MÁS DE UNA PALABRA     
        $sql_total="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE)
        FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) AND EMPRESA = 'ZOOM' LIMIT 0,80";
        $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));
      }  

      $tamano_paginas=3; //paginación  

      if(isset($_GET["pagina"]))
      {
       $pagina=$_GET["pagina"];      
      }
      else
      {
       $pagina=1;
      }    
      
      $total_paginas=ceil($num_rows_total/$tamano_paginas);

      $empezar_desde=($pagina-1)*$tamano_paginas; 
      //consulta segun numero de palabras
      if ($numero==1) 
      { //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
        $consulta="SELECT * FROM agencias WHERE EMPRESA = 'ZOOM' AND (EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%') LIMIT $empezar_desde,$tamano_paginas";

        $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //MENSAJE DE ERROR
          </script> 
        <?php
      }
  
    }
    else
    {//HAY MÁS DE UNA PALABRA
      $consulta="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) AND EMPRESA = 'ZOOM' HAVING relevancia > 0.2 ORDER BY relevancia DESC LIMIT $empezar_desde,$tamano_paginas";
      
      $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //NO HAY COINCIDENCIAS 
          </script> 
        <?php
      }    
    }  

    break;  

    case "DOMESA":

    if ($numero==1) 
      { //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE     
        $sql_total="SELECT * FROM agencias WHERE EMPRESA = 'DOMESA' AND (EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%') LIMIT 0,80";

        $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));      
      }
      else
      {  //HAY MÁS DE UNA PALABRA
        $sql_total="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE)
        FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) AND EMPRESA = 'DOMESA' LIMIT 0,80";
        $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));
      }  
      
      $tamano_paginas=3;  //paginación  

      if(isset($_GET["pagina"]))
      {
        $pagina=$_GET["pagina"];      
      }
      else
      {
        $pagina=1;
      } 
      $total_paginas=ceil($num_rows_total/$tamano_paginas);

      $empezar_desde=($pagina-1)*$tamano_paginas; 
      //consulta segun numero de palabras
      if ($numero==1) 
      { //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 
        $consulta="SELECT * FROM agencias WHERE EMPRESA = 'DOMESA' AND (EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%') LIMIT $empezar_desde,$tamano_paginas";

        $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //NO HAY COINCIDENCIAS 
          </script> 
        <?php
      }
  
    }
    else
    {//HAY MÁS DE UNA PALABTA
      $consulta="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) AND EMPRESA = 'DOMESA' HAVING relevancia > 0.2 ORDER BY relevancia DESC LIMIT $empezar_desde,$tamano_paginas";
      
      $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //NO HAY COINCIDENCIAS 
          </script> 
        <?php
      }    
    }  

    break;  

    case "TEALCA":

    if ($numero==1) 
      {//SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 
      
        $sql_total="SELECT * FROM agencias WHERE EMPRESA = 'TEALCA' AND (EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%') LIMIT 0,80";

        $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));      
      }
      else
      { //HAY MÁS DE UNA PALABRA       
        $sql_total="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE)
        FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) AND EMPRESA = 'TEALCA' LIMIT 0,80";
        $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));
      }  

      $tamano_paginas=3; //paginación  

      if(isset($_GET["pagina"]))
      {
       $pagina=$_GET["pagina"];      
      }
      else
      {
       $pagina=1;
      } 
    
      $total_paginas=ceil($num_rows_total/$tamano_paginas);

      $empezar_desde=($pagina-1)*$tamano_paginas; 
      //consulta segun numero de palabras
      if ($numero==1) 
      { //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 
        $consulta="SELECT * FROM agencias WHERE EMPRESA = 'TEALCA' AND (EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%') LIMIT $empezar_desde,$tamano_paginas";

        $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //NO HAY COINCIDENCIAS 
          </script> 
        <?php
      }
  
    }
    else
    {//HAY MÁS DE UNA PALABRA 
      $consulta="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) AND EMPRESA = 'TEALCA' HAVING relevancia > 0.2 ORDER BY relevancia DESC LIMIT $empezar_desde,$tamano_paginas";
      
      $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3();  //NO HAY COINCIDENCIAS 
          </script> 

        <?php
      }
    
    }  
    break;  

    }
  }
  else //isset existe un filtro
  {
     if ($numero==1) 
    { //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE     
      $sql_total="SELECT * FROM agencias WHERE EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%' LIMIT 0,80";

      $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));      
    }
    else
    { //HAY MÁS DE UNA PALABRA 
     $sql_total="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) LIMIT 0,80";
      
      $num_rows_total = mysqli_num_rows(mysqli_query($conexion,$sql_total));
    }
    
    $tamano_paginas=3;//Paginación

    if(isset($_GET["pagina"]))
    {
     $pagina=$_GET["pagina"];      
    }
    else
    {
      $pagina=1;
    }    
    
    $total_paginas=ceil($num_rows_total/$tamano_paginas);

    $empezar_desde=($pagina-1)*$tamano_paginas; 
    //consulta segun numero de palabras
    if ($numero==1) 
    { //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 
      $consulta="SELECT * FROM agencias WHERE EMPRESA LIKE '%$busqueda%' OR COD_AGE LIKE '%$busqueda%' OR NOM_AGE LIKE '%$busqueda%' OR DIR_AGE LIKE '%$busqueda%' OR EST_AGE LIKE '%$busqueda%' OR CIU_AGE LIKE '%$busqueda%' LIMIT $empezar_desde,$tamano_paginas";

      $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //NO HAY COINCIDENCIAS
          </script> 
        <?php
      }
    }
    else
    { //HAY MÁS DE UNA PALABRA
      $consulta="SELECT *, MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE) as relevancia
      FROM agencias WHERE MATCH (EMPRESA,NOM_AGE,DIR_AGE,EST_AGE,CIU_AGE) AGAINST ('$busqueda' IN BOOLEAN MODE ) HAVING relevancia > 0.2 ORDER BY relevancia DESC LIMIT $empezar_desde,$tamano_paginas";
      
      $num_rows = mysqli_num_rows(mysqli_query($conexion,$consulta));

      if($num_rows==0)
      {
        ?>
          <script language="javascript"> 
            validacion3(); //NO HAY COINCIDENCIAS
          </script> 
        <?php
      }   
    }
  
  } //else if isset existe un filtro
      
    $resulados= mysqli_query($conexion,$consulta);
   
    if($num_rows>0)
    {
    //haciendo la tabla responsive  
      ?>         
      <div class= "tabla" >    
        <div class="sql-search">
          <p>Cerca de <?php echo $num_rows_total?> resultados para: <strong><?php echo $busqueda?></strong></p>
        </div>
      <?php

        echo "<table><tr>";      //creamos la tabla
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
      echo "<td>".$fila['EMPRESA']. "</td>";
      echo "<td class='centered'>".$fila['COD_AGE']."<br><a href='popup.php?cod_int=".$fila['COD_INT']."' onclick='popupwindow();' target='pop'>Ver agencia</a></td>";
      echo "<td>".$fila['NOM_AGE']. "</td>";
      echo "<td>".$fila['TEL_AGE']. "</td>";
      echo "<td>".$fila['HOR_AGE']. "</td>";
      echo "<td>".$fila['DIR_AGE']. "</td>";
      echo "<td>".$fila['EST_AGE']. "</td>";
      echo "<td>".$fila['CIU_AGE']. "</td></tr>";    
   }

      echo "</table>";                            //cerramos la tabla
  ?>    
            
  <?PHP        

    //-------------------paginacion
    //muestro los distintos índices de las páginas, si es que hay varias páginas 
    if ($total_paginas > 1 )
    { 
      ?>
        <div class="sql-search">  
          <p>Página <?php echo $pagina?>  de  <?php echo$total_paginas?> </p>
        </div>  

      </div><!--  table -->

      <div class="main_pagination">  
       <div class="pagination">        
       <?php      
       
    if(empty($_GET["filtro"]))  //valido si existe un filtro
    {

       if ($pagina !=1 )
       {//simbolo de anterior
          echo "<a href='index.php?searchterm=$busqueda&pagina=".($pagina-1)."'><strong><<</strong></a>";
       }                                                     

      for ($i=1;$i<=$total_paginas;$i++)
      { 
        if ($pagina == $i) 
          //si muestro el índice de la página actual, no coloco enlace 
          echo "<span>$pagina</span>"; 
        else 
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
          echo "<a href='index.php?searchterm=$busqueda&pagina=$i'>  $i </a>";
      }

      if ($pagina !=$total_paginas)
       {//simbolo de siguiente
          echo "<a href='index.php?searchterm=$busqueda&pagina=".($pagina+1)."'><strong>>></strong></a>";
       }      

    }
    else //si hay un filtro
    {
         if ($pagina !=1)
       { //simbolo de anterior          
          echo "<a href='index.php?searchterm=$busqueda&filtro=$filtro&pagina=".($pagina-1)."'><strong><<</strong></a>";
       }                                                     

      for ($i=1;$i<=$total_paginas;$i++)
      { 
        if ($pagina == $i) 
          //si muestro el índice de la página actual, no coloco enlace      
          echo "<span>$pagina</span>"; 
        else 
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
          echo "<a href='index.php?searchterm=$busqueda&filtro=$filtro&pagina=$i'>  $i </a>";
      }

      if ($pagina !=$total_paginas)
       {//simbolo de siguiente
          echo "<a href='index.php?searchterm=$busqueda&filtro=$filtro&pagina=".($pagina+1)."'><strong>>></strong></a>";
       }      

     }// isset get filtro

    }
       ?>
       
       </div> 
      </div>  
       <?php

    //cerramos la conexiòn
    mysqli_close($conexion);
} 
else //isset existe el searchterm
{
  ?>
    <script language="javascript"> 
     show(); //MUESTRO EL PRIMER MENU
    </script> 
  <?php
} 

?>
 
 <div class="footer">
    <div class="footer_resize">
          
      <div class="lefttt">
        <p >© Páginas web desde 2017 BUSCATUAGENCIA.COM.VE Todos los derechos reservados.<br />
        <a href="index.php"> Inicio </a> | <a href="contacto.html"> Contacto |</a></p>
      </div>

      <div class="righttt">
        <p><a href="index.php"><span>buscatuagencia.com.ve</span></a></p>
      </div>

    </div>
  </div>

</div>

</body>
</html>

