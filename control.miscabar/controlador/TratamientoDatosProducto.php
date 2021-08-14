<?php
include_once "Producto.php";
include_once "Departamento.php";
include_once "Marca.php";
include_once "Proveedor.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['btnGuardar'])){
    $p = new Producto();
    $fila = $p->ConsultarXID($_POST["ipt_Codigo"])->num_rows;
    
    $p->setCodigo($_POST['ipt_Codigo']);
    $p->setDescripcion($_POST["ipt_Descripcion"]);
    $p->setPrecioMayoreo(str_replace(",",".",$_POST["ipt_Mayoreo"]));
    $p->setFk_presentacionProducto($_POST["presentacion"]);
    $p->setCosto(str_replace(",",".",$_POST["ipt_Costo"]));
    $p->setPrecioUnitario(str_replace(",",".",$_POST["ipt_venta"]));
    $marca = new Marca;
    if(empty($marca->ConsultarXNombre($_POST["ipt_marca"]))){
        $marca->setNombre($_POST["ipt_marca"]);
        $marca->registrar();
    }
    $p->setFk_idMarca($marca->getId());
    
    $depto = new Departamento;
    if(empty($depto->ConsultarXNombre($_POST["ipt_departamento"]))){
        $depto->setNombre($_POST["ipt_departamento"]);
        $depto->registrar();
    }
    $p->setFk_idDepartamento($depto->getId());
    
    $proveedor = new Proveedor;
    if(empty($proveedor->ConsultarXNombre($_POST["ipt_proveedor"]))){
        $proveedor->setNombre($_POST["ipt_proveedor"]);
        $proveedor->registrar();
    }
    $p->setFk_idProveedor($proveedor->getId());  
    
    if($fila>0)
    {
        $p->Modificar();
    }else{
        $p->Registrar();
    }

    header('Location: ../Productos.php');
    
}
if(isset($_POST['btnEliminar'])){
    $p = new Producto();
    if($p->ConsultarXID($_POST['ipt_Codigo'])){
        $p->Eliminar();
    header('Location: ../Productos.php');    
    }else
    {
        echo "<p><a href = '../gestionProductos.php'>Regresar a Pagina Gestion de Productos</a></p>";
    }
}

}

?>