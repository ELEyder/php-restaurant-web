<?php
    require_once("funciones.php");

    $cn=fnConnect($msg);
    //Si hay error en la conexion
    if(!$cn){
        //Mostrar el mensaje de error
        fnShowMsg("Error", $msg);
        say("</body>");
        return; //Salir
    }
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
        <div class="fondo">
        <div class="registro-contenedor">
        <div class="reg-cont-contenido">
            <form method="post" action="registro.php">
                <div class="detalles-user">
                    <div class="input-box">
                        <span class="details">Nombres: </span>
                        <input type="text" name="txtNombre" placeholder="Ingrese su nombre">
                    </div>
                    <div class="input-box">
                        <span class="details">Apellidos: </span>
                        <input type="text" name="txtApellidos" placeholder="Ingrese sus apellidos">
                    </div>
                    <div class="input-box">
                        <span class="details">Usuario: </span>
                        <input type="text" name="txtUsser" placeholder="Ingrese su usuario">
                    </div>
                    <div class="input-box">
                        <span class="details">Clave: </span>
                        <input type="text" name="txtClaveR" placeholder="Ingrese su clave">
                    </div>
                    <div class="input-box">
                        <span class="details">Email: </span>
                        <input type="email" name="txtEmail" placeholder="Ingrese su email">
                    </div>
        
                    
                </div>
                <br><input type="submit" name="btnRegistrarse" value="Registrarse">
                <input type="submit" name="btnBack" value="Volver">
            </form>

        </div>
        </div>
        </div>
    </body>
</html>


<?php

    if(isset($_POST["btnRegistrarse"])){

        if(isset($_POST["txtNombre"]) && isset($_POST["txtApellidos"]) && $_POST["txtUsser"] && $_POST["txtClaveR"] && $_POST["txtEmail"]){
            $nombre=$_POST["txtNombre"];
            $apellidos=$_POST["txtApellidos"];
            $usuario=$_POST["txtUsser"];
            $clave=$_POST["txtClaveR"];
            $email=$_POST["txtEmail"];
            // say("<br><label>$nombre</label>");
        
            mysqli_query($cn, "begin");
        
            $sql="INSERT INTO clientes(Nombres,Apellidos,Usuario,Clave,Correo) ";
            $sql .="VALUES('$nombre','$apellidos','$usuario','$clave','$email')";
        
            $rpta=mysqli_query($cn,$sql);
        
            if(!$rpta){
                //cancelar la transaccion con el comando rollback
                mysqli_query($cn, "rollback");
                //mostrar el mensaje de error
                $msg="Datos ingresados no son correctos <br>";
                $msg .="SQL : $sql";
                fnShowMsg("Error", $msg);
                say("</body>");
                return; //salir
        
            }
            else{
                say("<div class='msg-registro-container'>");
                say("<div class='msg-registro'>");
                say("<p>DATOS REGISTRADOS</p>");
                say("</div>");
                say("</div>");
            }
        
            mysqli_query($cn,"commit");
        }else{
            say("<div class='msg-registro-container'>");
            say("<div class='msg-registro'>");
            say("<p>Llene los campos</p>");
            say("</div>");
            say("</div>");
        }


    }

    if(isset($_POST["btnBack"])){
        fnRedirect('index.php');
    }



?>