<?php
/**
 * Este archivo realiza la operacion de destruir la sesion y adicional canaliza al usuario a
 * la pagina principal  
 * 
 */

session_destroy();

header("Location: /index.php");

?>