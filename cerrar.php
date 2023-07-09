<?php
    require_once("funciones.php");
    fnSessionStart();
    fnSessionEnd();
    fnRedirect("index.php?op=1");

?>