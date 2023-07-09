<?php
    require_once("funciones.php");

    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }
    if($_SESSION["codigo"]!=""){
        //Llamar a la pagina default.php
        fnRedirect("index.php");
        return; //Salir
    }

?>
<div class="login-contenedor">
    <div class="log-form-contenedor">
    <form action="login2.php" method="post">
        <span class="details">Usuario: </span>
        <input type="text" name="txtusuario" required>
        <span class="details">Clave: </span>
        <input type="password" name="txtClaveL" required>
        <input type="submit" name="btnEnviar" value="Iniciar sesion"><br><br>
        <?php
            say(fnLink("registro.php","","Registro","No tiene cuenta? Registrese"));
        ?>
    </form>
    </div>
</div>