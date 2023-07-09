<?php
    require_once("funciones.php");
    session_start();

    if($_SESSION["codigo"]){
        fnRedirect("index.php?op=3");
        return;
    }

    $cuenta=$_POST["txtusuario"];
    $clave=$_POST["txtClaveL"];
    $msg="";

    $cn=fnConnect($msg);

    $sql="select Usuario,Clave from clientes ";
    $sql.="where Usuario='$cuenta' and Clave='$clave'";

    $rs=mysqli_query($cn,$sql);
    $rows=mysqli_num_rows($rs);

    if($rows==0){
        say("Datos incorrectos");
        return;
    }

    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);

    $_SESSION["codigo"]=$row["Clave"];
    $_SESSION["nombre"]=$row["Usuario"];

    fnRedirect("index.php?op=3");



?>