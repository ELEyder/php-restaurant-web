<?php
    require_once("funciones.php");
    fnSessionStart();

    if($_SESSION["nombre"]!="admin"){
        fnRedirect("index.php");
    }

    $cn=fnConnect($msg);
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
            <h1>Lista de platillos</h1>
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
                        <th>Plato</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $busqueda = "";
                    $cont=0;
                    if(isset($_POST["search"]) && !$_POST["search"]==""){
                        $busqueda=$_POST["search"];
                        $sql="select * from platos where PlatoID='$busqueda' or Plato='$busqueda';";
                        $rs2=mysqli_query($cn,$sql);
                        while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                            $cont++;
                        }
                        if($cont==0){
                            say("<tr>");
                            say("<td colspan=3 >No se a encontrado el platillo...!</td>");
                            say("</tr>");
                        
                        }else{
                            $rs2=mysqli_query($cn,$sql);
                            say("<tr>");
                            while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                            
                                say("<td>".$row['PlatoID']."</td>");
                                say("<td>".$row['Plato']."</td>");
                                say("<td>".$row['Precio']."</td>");
                                
                                say("</tr>");
                            }
                        }
                            

                            
                    }
                    else if(isset($_POST["search"]) and $_POST["search"]==""){
                        say("<tr>");
                        $sql="select * from platos";
                        $rs2=mysqli_query($cn,$sql);
                        while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                        
                            say("<td>".$row['PlatoID']."</td>");
                            say("<td>".$row['Plato']."</td>");
                            say("<td>".$row['Precio']."</td>");
                            
                            say("</tr>");
                        }
                    }
                    else if(!isset($_POST["search"])){
                        say("<tr>");
                        $sql="select * from platos";
                        $rs2=mysqli_query($cn,$sql);
                        while($row=mysqli_fetch_array($rs2,MYSQLI_ASSOC)){
                        
                            say("<td>".$row['PlatoID']."</td>");
                            say("<td>".$row['Plato']."</td>");
                            say("<td>".$row['Precio']."</td>");
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