<?php
require_once("funciones.php");
    fnSessionStart();

    $cn=fnConnect($msg);
    $rs = mysqli_query($cn,"select * from platos");
    say("<div class='table'>");
    say("<div class='table-header'>");
    say("<h1>Platillos</h1>");
    say("</div>");
    say("<div class='table-body'>");
    say("<table border=0>");
    // say("<tr>");
    // say("<th colspan = '10'>  a  </th>");
    // say("</tr>");
    $col = 0;
    say("<tr>");
    while($row = mysqli_fetch_array($rs,MYSQLI_ASSOC)){
        say("<td align=center valign=middle>");
        //say("<a href='index.php'><img src='fotos/".$row["PlatoID"].".jpg' width='250'
        //heigth='250' border='1'></a> <br>");
        if($_SESSION["codigo"]){
            say("<a href='pedido.php?plato=".$row["PlatoID"]."'>".$row["Plato"]."</a><br>");
        }else{
            say("<a href='index.php?op=1'>".$row["Plato"]."</a><br>");
        }
        say("Precio: ".$row["Precio"]."</td>");

        if($_SESSION["codigo"]){
            say("<td>".fnLink("pedido.php?plato=".$row["PlatoID"],"","plato","<img src='fotos/".$row["PlatoID"].".jpg' width='250'
            heigth='150' border='1'>")."</td>");

        }else{
            say("<td>".fnLink("index.php?op=1","","plato","<img src='fotos/".$row["PlatoID"].".jpg' width='250'
            heigth='150' border='1'>")."</td>");
        }

        $col++;
        if($col % 2 == 0){say("</tr><tr>");}
    }
    
    say("</tr></table></div></div>");
?>