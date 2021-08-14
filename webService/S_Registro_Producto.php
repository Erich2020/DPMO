<?php

include "Producto.php";
include "RelacionRegistros.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
$p = new Producto();
$rr = new relacionRegistros();

$p->setCodigo($_POST['codigo']);
$p->setDescripcion($_POST["descripcion"]);
$p->setPresentacion($_POST["presentacion"]);
$p->setCosto($_POST["costo"]);
$p->setPrecioUnitario($_POST["precio"]);
$p->setMarca($_POST["marca"]);
$rr->setfk_Username($_POST["username"]);
$rr->setfk_Codigo($_POST["codigo"]);

if($p->Registrar() === TRUE & $rr->Registrar() === TRUE){
    header("HTTP/1.1 200");
    echo json_encode("Se ha Realizado el Registro con &Eacute;xito!");
}else {
    header("HTTP/1.1 400");
    echo json_encode("Ha Ocurrido un Error en el Registro!");
}

}


?>