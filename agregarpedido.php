<?php
    require_once("funciones.php");
    fnSessionStart();

    if($_SESSION["nombre"]!="admin"){
        fnRedirect("index.php");
    }

    $cn=fnConnect();
    //Si hay error en la conexion
    if(!$cn){
        //Mostrar el mensaje de error
        say("</body>");
        return; //Salir
    }
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
    <div class='fondo'>
        <div class="registro-contenedor">
        <div class="reg-cont-contenido">
        <form method="post" action="agregarpedido.php">
            <div class="detalles-user">
                <div class="input-box">
                    <span class="details">Nombres: </span>
                    <input type="text" name="txtNombre" placeholder="Ingrese sus Nombres">
                </div>
                <div class="input-box">
                    <span class="details">Apellidos: </span>
                    <input type="text" name="txtApellidos" placeholder="Ingrese sus Apellidos">
                </div>
                <div class="input-box">
                    <span class="details">Usuario: </span>
                    <input type="text" name="txtUsser" placeholder="Ingrese su Usuario">
                </div>
                <div class="input-box">
                    <span class="details">Email: </span>
                    <input type="email" name="txtEmail" placeholder="Ingrese su Email">
                </div>
                <div class="input-box">
                    <span class="details">Direccion: </span>
                    <input type="text" name="txtDireccion" placeholder="Ingrese su Direccion">
                </div>
                <div class="input-box">
                <span class="details">Plato: </span>
                    <?php
                            say("<select name='txtPlato'>");
                            $sql="select * from platos";
                            $rs3=mysqli_query($cn,$sql);
                            while($row3=mysqli_fetch_array($rs3,MYSQLI_ASSOC)){
                                say("<option value='".$row3["Plato"]."'>".$row3["Plato"]."</option>");
                            }
                            say("</select>");
                    ?>
                </div>
                <div class="input-box">
                    <span class="details">Cantidad: </span>
                    <input type="number" min =1 name="txtCantidad" placeholder="Ingrese su Cantidad">
                </div>
            </div>
            <br><input type="submit" name="btnAgregar" value="Agregar">
            <input type="submit" name="btnBack" value="Volver">
        </form>
        </div>

        </div>
    </div>
    </body>
</html>
<?php

    if(isset($_POST["btnAgregar"])){

        if(isset($_POST["txtNombre"]) && isset($_POST["txtApellidos"]) &&isset($_POST["txtUsser"])  && isset($_POST["txtEmail"])  && isset($_POST["txtDireccion"]) && isset($_POST["txtPlato"]) && isset($_POST["txtCantidad"]) ){
            $nombre=$_POST["txtNombre"];
            $apellidos=$_POST["txtApellidos"];
            $usuario=$_POST["txtUsser"];
            $email=$_POST["txtEmail"];
            $direccion=$_POST["txtDireccion"];
            $plato=$_POST["txtPlato"];
            $cantidad=$_POST["txtCantidad"];

            $sql ="SELECT * from platos where Plato='".$_POST["txtPlato"]."';";
            $rs2=mysqli_query($cn,$sql);
            $row=mysqli_fetch_array($rs2,MYSQLI_ASSOC);
            $pagar = $cantidad * $row["Precio"];

            
            mysqli_query($cn, "begin");
        
            $sql="INSERT INTO pedidos(Nombres,Apellidos,Usuario,Correo,Direccion,Plato,Cantidad,Pagar) ";
            $sql .="VALUES('$nombre','$apellidos','$usuario','$email','$direccion','$plato',$cantidad,$pagar)";
        
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