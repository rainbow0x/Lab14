<?php

session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 14.3</title>

    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <?php
    if (isset($_SESSION["usuario_valido"])) {

    ?>
        <h1>Consulta de noticias</h1>

    <?php
       require_once("class/noticias.php");
       $por_pagina = 5;
       
       
       if (isset($_GET['pagina']))
       {
           $pagina = $_GET['pagina'];
       }
       else
       {
           $pagina = 1;
       }
       
       if ($pagina == 0 )
       {
           $cantidad = ($pagina) * $por_pagina;
       }
       else
       {
           $cantidad = ($pagina-1)* $por_pagina;
       }
       
       
       $obj_noticia=new noticia();
       $noticias=$obj_noticia->paginas($cantidad , $por_pagina);
       
       
       $nfilas=count($noticias);
       
       echo "Pagina: ";
       for ($i=1; $i<=$cantidad+2; $i++)
           {
               echo "<a href= 'lab143.php?pagina=".$i."'>.". $i ."</a>";
           }
       
       
       
       if($nfilas>0){
           print("<TABLE>\n");
           print("<TR>\n");
           print("<TH>Titulo</TH>\n");
           print("<TH>Texto</TH>\n");
           print("<TH>Categoria</TH>\n");
           print("<TH>Fecha</TH>\n");
           print("<TH>Imagen</TH>\n");
           print("</TR>\n");
       
           foreach($noticias as $resultado){
               print("<TR>\n");
               print("<TD>".$resultado['titulo']."</TD>\n");
               print("<TD>".$resultado['texto']."</TD>\n");
               print("<TD>".$resultado['categoria']."</TD>\n");
               print("<TD>".date("j/n/Y",strtotime($resultado['fecha']))."</TD>\n");
       
               if($resultado['imagen']!="")
               {
                   print ("<TD><A TARGET='_blank' HREF='img/".$resultado['imagen']."'>
                   <IMG BORDER='0' SRC='img/iconotexto.gif'></A></TD>\n");
               }
               else
               {
                   print ("<TD>&nbsp;</TD>\n");
               }
               print ("</TR>\n");
           }
           print ("</TABLE\n");
       }
       else{
           print ("<br><br>No hay noticias disponibles");
       }
       print("<p>[<a href='/Lab14/login.php'>Menu Principal </a>]</p>");
    } else {
        print("<br><br>\n");
        print("<P align='center'>Acceso no autorizado</P>\n");
        print("<P align='center'>[<a href='login.php' target='_top'>Conectar</a>]</P>\n");
    }

    ?>

</body>

</html>