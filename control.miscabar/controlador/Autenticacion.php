<?php
/**
 * Este archivo realiza el tratamiento de los datos enviados por el fron-end para realizar 
 * la autenticacion del usuario y así mismo genera una solucion de _session() para mantener una sesion de usuario
 * evitando así el logeo continuo y ayudando a la seguridad 
 */
include_once ("Usuario.php");
$usuario=$_POST["usuario"];
$contrasena = $_POST["contrasena"];
$usr = new Usuario(); 
$s = $usr->AutenticarUsuario($usuario, $contrasena);
if($s){

    header("Location: ../index.php");
}else{
    header("Location: ../login.php");
}
?>