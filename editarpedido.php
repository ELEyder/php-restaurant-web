<?php
    require_once("funciones.php");
    fnSessionStart();

    if($_SESSION["nombre"]!="admin"){
        fnRedirect("index.php");
    }
    $cn=fnConnect();
    if(!$cn){
        //Mostrar mensaje de error
        fnShowMsg("Error",$msg);
        say("</body>"); //Finalizar el cuerpo de la pagina
        return; //Salir
    }
?>

<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="estilo.css" rel="stylesheet">
</head>
<body>
    <?php
        fnMenu();
    ?>
    <div class="contenido">
    <main class="table">
        <div class="table-header">
            <h1>Edita el Pedido</h1>

        </div>
        <div class="table-body">
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Direcci&oacute;n</th>
                        <th>Plato</th>
                        <th>Cantidad</th>
                        <!-- <th>Total Pago</th> -->
                        <th>Confirmaci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $busqueda=0;

                    if(isset($_GET["id"])){
                        $busqueda=$_GET["id"];
                        say("<tr>");
                        $sql="select * from pedidos where PedidoID='$busqueda'";
                        $rs2=mysqli_query($cn,$sql);
                        while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                        $costo = 0.00;
                        $costo = $row["Pagar"] / (double)$row["Cantidad"];
                            say("<td>".$row['PedidoID']."</td>");
                            say("<td>".$row['Nombres']."</td>");
                            say("<td>".$row['Apellidos']."</td>");
                            say("<td>".$row['Usuario']."</td>");
                            say("<td>".$row['Correo']."</td>");

                            // say("<td>".$row['Direccion']."</td>");
                            say("<form method='post' action='actualizarpedido.php?id=".$busqueda."'>");
                            say("<td><input type='text' name='txtdic' value='".$row["Direccion"]."'></td>");
                            say("<td>");
                            say("<select name='txtplato'>");
                            $sql="select * from platos";
                            $rs3=mysqli_query($cn,$sql);
                            while($row3=mysqli_fetch_array($rs3,MYSQLI_ASSOC)){
                                say("<option value='".$row3["Plato"]."'>".$row3["Plato"]."</option>");
                            }
                            say("</select>");
                            say("</td>");
                            say("<td><input name='txtcant' type='number' id='input' min='1' style='width: 48px;' value='".$row["Cantidad"]."'></td>");
                            // say("<td> S/.<span id='result'>".$row["Pagar"]."</span></td>");
                            // say("
                            // <script>
                            // input.oninput = function() {
                            //     result.innerHTML = (input.value * $costo).toFixed(2);
                            // };
                            // </script>");
                            say("<td>");
                            say("<input type='image' src='fotos\si.png' width='30' height='30' >");
                            say("<input type='image' src='fotos\\no.png' width='30' height='30' formaction='index.php'> ");
                            say("</form>");
                            say("</td>");
                            say("</tr>"); 
                        }
                    }
                    else{
                        say("<tr>");
                        say("NO HAY ID");
                        say("</td>");
                        say("</tr>");
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
        
    </main>
    </div>
</body>
</html>