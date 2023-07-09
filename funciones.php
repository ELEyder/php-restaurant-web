<?php

function say($cad){
    echo $cad."\n";
}

function fnSessionStart(){
    //Si no ha iniciado Sesión
    if (session_status() == PHP_SESSION_NONE) {
    session_start(); //Iniciar sesion de trabajo
    }   
    if(!isset($_SESSION["codigo"])){
	    $_SESSION['codigo'] = '';
	    $_SESSION['nombre'] = 'Inicie sesi&oacute;n';
	    // $_SESSION['canasta'] = null;
	    // $_SESSION['seguro'] =  fnRnd( 1000, 9999 ); //El seguro de la sesion es un numero aleatorio
	}
        
}

function fnSessionEnd(){
	session_unset();
	session_destroy();
}

function fnRedirect($pagina){
    $cad = "Location: http://" . $_SERVER['HTTP_HOST']
        . dirname($_SERVER['PHP_SELF']) . "/$pagina";
    header( $cad, True );
}

function fnLink($link,$target,$mouseover,$msg){
	$cad = "<A href='$link' target='$target' ";
	$cad .= "onmouseout=\"self.status='';return true\" ";
	$cad .= "onmouseover=\"self.status='$mouseover' ;return true\">";
	$cad .= "$msg</A>";
	return $cad;
}

function fnShowMsg($title,$msg){
    say("<table align='center' width='300' border='1'>");
    say("<tr>");
    say("<th>$title</th>");
    say("</tr>");
    say("<tr>");
	say("<td>$msg</td>");    
    say("</tr>");
    say("</table>");
}

function fnMenu(){
    say("<div class='menu'>");
    
    say("<span class='titulo'>Restaurant</span>");
    say("<ul class='main-menu'>");
    if($_SESSION["codigo"]){
        say("<li class='menu-item'>".fnLink("cerrar.php","","Terminar Sesion","Logout")."</li>");
    }else{
        say("<li class='menu-item'>".fnLink("index.php?op=1","","Login","Login")."</li>");
    }
    say("<li class='menu-item'>".fnLink("index.php?op=3","","Mostrar catalogo","Catalogo")."</li>");
    if($_SESSION["nombre"]=="admin"){
        say("<li class='menu-item'>".fnLink("index.php?op=4","","Mostrar ListaCatalogo","Lista Catalogo")."</li>");
        say("<li class='menu-item'>".fnLink("index.php?op=5","","Mostrar Lista Pedidos","Lista Pedidos")."</li>");
    }
    say("<li class='cta'><span>Cuenta: ".$_SESSION["nombre"]."</span></li>");
    say("</ul>");
    say("</div>");
}

function fnConnect( &$msg ){
	$cn=mysqli_connect("localhost","root","");
	if(!$cn){
		$msg = "Error en la conexión.";
		return 0;
	}
	$n = mysqli_select_db($cn,"tr");
	if(!$n){
		$msg = "Base de datos no existe.";
		mysqli_close($cn);
		return 0;
	}
	return $cn;
}

?>