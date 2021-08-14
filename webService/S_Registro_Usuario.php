<?php
include "Usuario.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $u = new Usuario();

    $u->setNombre($_POST['nombre']);
    $u->setUserName ($_POST['username']);
    $u->setPWD($_POST['pwd']);

    if($u->Registrar()=== TRUE){
        header("HTTP/1.1 200");
    }else header("HTTP/1.1 400");

}

?>