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

$sql ="SELECT * from platos where Plato='".$_POST["txtplato"]."';";
$rs2=mysqli_query($cn,$sql);
$row=mysqli_fetch_array($rs2,MYSQLI_ASSOC);
$pagar = $_POST["txtcant"] * $row["Precio"];

mysqli_query($cn, "begin");
        
$sql=  "UPDATE pedidos ";
$sql .="SET Direccion = '".$_POST['txtdic']."',Plato='".$_POST["txtplato"]."',";
$sql .="Cantidad = ".$_POST["txtcant"].", Pagar=".$pagar." where PedidoID='".$_GET["id"]."';";
        
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
    fnRedirect("index.php?op=5");
}
        
mysqli_query($cn,"commit");

echo $_POST["txtdic"];
echo $_POST["txtplato"];
echo $_POST["txtcant"];
?>