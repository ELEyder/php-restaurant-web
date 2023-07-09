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
    $plato=1;

        if(isset($_GET["plato"])){
            $plato=$_GET["plato"];
        }
    
        fnSessionStart();
    $cn=fnConnect($msg);
    $rs = mysqli_query($cn,"select * from platos where PlatoID = ". $plato);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
?>
<html>
    <head>
    <link rel='stylesheet' type='text/css' href='estilo.css'>
    <script src='script.js' defer></script>
    </head>
    <body>
    <?php
    $platonombre=$row["Plato"];
    $precio = 0.0;
    $precio=$row["Precio"];
    //Hacemos la tabla
    $cont=1;
        say("<div class='contenido-pedido'>");
        say("<table border=1 class='tabla-pedido'>");
        say("   <tr>");
        say("       <th colspan = '2'>  Completa el pedido.  </th>");
        say("   </tr>");
        say("   <tr>");
        say("       <td align=center valign=middle>");
        say(            $platonombre."<br>");
        say(            "Precio: ".$precio);
        say("       </td>");
        say("       <td>");
        say("           <img src='fotos/".$row["PlatoID"].".jpg' width='250' heigth='250' border='1'>");
        say("       </td>");
        say("   </tr>");
        say("   <tr>");
        say("       <td>");
        say("           Cantidad: ");
        say("       </td>");
        say("       <td>");
        say("           <button id='disabledBtn' onclick='addValueFunction(this)' value='decrease'>");
        say("               <");
        say("           </button>");
        say("           <button onclick='addValueFunction(this)' value='increase'>");
        say("               >");
        say("           </button>");
        say("           <form method='post'>");
        say("           <input id='amount' type='text' name='cant' value='1' readonly='readonly'>");
        say("       </td>"); 
        say("   </tr>");
        say("   <tr>");
        say("   <td>Dirección</td>");
        say("   <td><input name='direc' type=text> </input> </td>");
        say("   </tr>");
        say("<tr> <td colspan='2'>");
        say("
            <input class='btnAceptar' type=submit value='Confirmar Pedido' name=aceptar></input>
            <input class='btnAceptar' type=submit value=Cancelar name=cancelar>
            </form>");
        say("</td></tr>");
        say("</table>");
        say("</div>");
            if (isset($_POST["cancelar"])){
                fnRedirect("index.php");
            } else if(isset($_POST["aceptar"])){
                $rs = mysqli_query($cn,"select * from clientes where Usuario='". $_SESSION["nombre"]."'");
                $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
                mysqli_query($cn, "begin");
                $pagar = 0.0;
                $pagar = (double)($_POST['cant'] * $precio);
                $sql="INSERT INTO pedidos(Nombres,Apellidos,Usuario,Correo,Direccion,Plato,Cantidad,Pagar) ";
                $sql .="VALUES('".$row['Nombres']."','".$row['Apellidos']."','".$row['Usuario']."','".$row['Correo']."','".$_POST['direc']."','".$platonombre."','".$_POST['cant']."','".$pagar."');";
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
                        echo "DATOS REGISTRADOS";
                        fnRedirect("index.php");
                    }
                
                    mysqli_query($cn,"commit");
        
            }
    ?>
    </div>
    </div>
    </body>
</html>

        
        
    
