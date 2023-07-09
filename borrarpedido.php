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

mysqli_query($cn, "begin");
        
$sql=  "DELETE FROM pedidos WHERE PedidoID='".$_GET["id"]."';";
        
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