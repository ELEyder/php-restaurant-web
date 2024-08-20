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
</head>
<body>
    <main class="table">
        <div class="table-header">
            <h1>Lista de pedidos</h1>
            <div class="add-pedido">
                <form method="post" action="agregarpedido.php">
                    <button><span class="img-add"><img src='fotos\add.png' width='30'></span><span class="text-add">Agregar pedido</span></button>
                </form>
            </div>
            <div class="search-container">
                <form method="post">
                    <span class="icon"><a href=""><i class="fa fa-search"></i></a></span>
                    <input type="search" name="search" placeholder="B&uacute;squeda">
                </form>
            </div>
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
                        <th>Total Pago</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $busqueda = "";
                    $cont=0;
                    if(isset($_POST["search"]) && !$_POST["search"]==""){
                        $busqueda=$_POST["search"];
                        $sql="select * from pedidos where PedidoID='$busqueda' or Nombres='$busqueda' or Apellidos='$busqueda' or Correo='$busqueda' or Usuario='$busqueda' or Plato='$busqueda';";
                        $rs2=mysqli_query($cn,$sql);
                        while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                            $cont++;
                        }
                        if($cont==0){
                            say("<tr>");
                            say("<td colspan=10 >No se a encontrado el pedido...!</td>");
                            say("</tr>");
                        
                        }else{
                            $rs2=mysqli_query($cn,$sql);
                            say("<tr>");
                            while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                            
                                say("<td>".$row['PedidoID']."</td>");
                                say("<td>".$row['Nombres']."</td>");
                                say("<td>".$row['Apellidos']."</td>");
                                say("<td>".$row['Usuario']."</td>");
                                say("<td>".$row['Correo']."</td>");
                                say("<td>".$row['Direccion']."</td>");
                                say("<td>".$row['Plato']."</td>");
                                say("<td>".$row['Cantidad']."</td>");
                                say("<td>".$row['Pagar']."</td>");
                                say("<td>");
                                say("<form method='post' action='editarpedido.php?id=".$row["PedidoID"]."'>");
                                say("<input type='image' src='fotos\pencil.png' width='20' height='20' name=edit2 formaction='editarpedido.php?id=".$row["PedidoID"]."'>");
                                say("<input type='image' name='delete' src='fotos\delete.png' width='20' height='20' formaction='borrarpedido.php?id=".$row["PedidoID"]."'>");
                                say("</form>");
                                say("</td>");
                                say("</tr>");
                            }
                        }
                            

                            
                    }
                    else if(isset($_POST["search"]) and $_POST["search"]==""){
                        say("<tr>");
                        $sql="select * from pedidos";
                        $rs2=mysqli_query($cn,$sql);
                        while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                        
                            say("<td>".$row['PedidoID']."</td>");
                            say("<td>".$row['Nombres']."</td>");
                            say("<td>".$row['Apellidos']."</td>");
                            say("<td>".$row['Usuario']."</td>");
                            say("<td>".$row['Correo']."</td>");
                            say("<td>".$row['Direccion']."</td>");
                            say("<td>".$row['Plato']."</td>");
                            say("<td>".$row['Cantidad']."</td>");
                            say("<td>".$row['Pagar']."</td>");
                            say("<td>");
                            say("<form method='post'>");
                            say("<input type='image' src='fotos\pencil.png' width='20' height='20' name=edit2 formaction='editarpedido.php?id=".$row["PedidoID"]."'>");
                            say("<input type='image' name='delete' src='fotos\delete.png' width='20' height='20' formaction='borrarpedido.php?id=".$row["PedidoID"]."'>");
                            say("</form>");
                            say("</td>");
                            say("</tr>");
                        }
                    }
                    else if(!isset($_POST["search"])){
                        say("<tr>");
                        $sql="select * from pedidos";
                        $rs2=mysqli_query($cn,$sql);
                        while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                        
                            say("<td>".$row['PedidoID']."</td>");
                            say("<td>".$row['Nombres']."</td>");
                            say("<td>".$row['Apellidos']."</td>");
                            say("<td>".$row['Usuario']."</td>");
                            say("<td>".$row['Correo']."</td>");
                            say("<td>".$row['Direccion']."</td>");
                            say("<td>".$row['Plato']."</td>");
                            say("<td>".$row['Cantidad']."</td>");
                            say("<td>".$row['Pagar']."</td>");
                            say("<td>");
                            say("<form method='post' action='editarpedido.php?id=".$row["PedidoID"]."'>");
                            say("<input type='image' src='fotos\pencil.png' width='20' height='20' name=edit2 formaction='editarpedido.php?id=".$row["PedidoID"]."'>");
                            say("<input type='image' name='delete' src='fotos\delete.png' width='20' height='20' formaction='borrarpedido.php?id=".$row["PedidoID"]."'>");
                            say("</form>");
                            say("</td>");
                            say("</tr>");
                        }
                    }
                    

                    
                    ?>
                </tbody>
            </table>
        </div>

    </main>
</body>
</html>