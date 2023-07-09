<?php
    require_once("funciones.php");
    fnSessionStart()
;?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <?php
        // require("titulo.html");
        fnMenu();
        say("<div class='contenido'>");
        $op=3;

        if(isset($_GET["op"])){
            $op=$_GET["op"];
        }

        switch($op){
            case 1:
                require("login.php");
                break;
            case 2:
                require("registro.php");
                break;
            case 3:
                require("catalogo.php");
                break;
            case 4:
                require("listacatalogo.php");
                break;
            case 5:
                require("listapedidos.php");
                break;
        }
        say("</div>");
    ?>

</body>
</html>