<?php
include ("Usuario.php");

if( $_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $u = new Usuario();
    if($u->AutenticarUsuario($_POST['username'], $_POST['pwd'])){
        header("HTTP/1.1 200");
    }else {
        header("HTTP/1.1 400");
    }

}
?>