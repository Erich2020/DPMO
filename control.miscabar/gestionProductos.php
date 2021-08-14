<?php 
/**
 * En esta seccion de PHP se realizan las validaciones internas dentro de la pagina para 
 * presentar los datos al cliente sin necesidad de redireccionar a otra pagina. 
 * Permitiendo ser a la pagina un poco mas dinamica
 * En este se cuentan con algunas secciones comentadas, que se estan considerando para agregar
 *  funcionalidad y facilidad a la pagina sobre las consultas de los productos 
 */
include_once ("Head.php");
include_once ("controlador/Producto.php");
include_once ("controlador/Departamento.php");
include_once ("controlador/Marca.php");
include_once ("controlador/Proveedor.php");
$departamento = new Departamento;
$marca = new Marca;
$proveedor = new Proveedor;

// limpia los campos y los prepara para que se registre un nuevo producto
if(isset($_GET["nuevo"]) & !empty($_GET["nuevo"])){
    $valueCodigo= "";
    $valueDescripcion = "";
    $valueCosto = "0";
    $valuePrecio = "0";
    $valueMayoreo = "0";
    $valueDepto = 'Sin Departamento';
    $valueMarca = 'Sin Marca';
    $valueProveedor = 'Sin Proveedor';
    $valuePresentacion = "<label><input type=\"radio\" id =\"rBn_Piezas\" name=\"presentacion\" value=\"1\" checked>Piezas/Paquete</label> <label><input type=\"radio\" id =\"rBnGranel\" name=\"presentacion\" value=\"2\" >Granel</label> <label><input type=\"radio\" id =\"rBnOtro\" name=\"presentacion\" value=\"3\">Otro</label>";
// inserta los valores de la consulta por Id del producto y permita su modificación o eliminación 
}else if(isset($_GET["codigo"]) & !empty($_GET["codigo"])){
    
    $producto = new Producto;

    $fila = $producto->ConsultarXID($_GET["codigo"]);
   
    if(isset($fila)){
            $valueCodigo= $producto->getCodigo();
            $valueDescripcion = $producto->getDescripcion();
            $valueCosto = $producto->getCosto();
            $valuePrecio = $producto->getPrecioUnitario();
            $valueMayoreo = $producto->getPrecioMayoreo();
            $valueDepto = $producto->getFk_idDepartamento();
            $valueMarca = $producto->getFk_idMarca();
            $valueProveedor = $producto->getFk_idProveedor();
            $presentacion = $producto->getFk_presentacionProducto();
            function validarPresentacion($presentacion){
                if($presentacion==1)
                {return "<label><input type=\"radio\" id =\"rBn_Piezas\" name=\"presentacion\" value=\"1\" checked>Piezas/Paquete</label> <label><input type=\"radio\" id =\"rBnGranel\" name=\"presentacion\" value=\"2\" >Granel</label> <label><input type=\"radio\" id =\"rBnOtro\" name=\"presentacion\" value=\"3\">Otro</label>";}
                else if($presentacion==2)
                {return "<label><input type=\"radio\" id =\"rBn_Piezas\" name=\"presentacion\" value=\"1\" >Piezas/Paquete</label><label><input type=\"radio\" id =\"rBnGranel\" name=\"presentacion\" value=\"2\" checked>Granel</label><label><input type=\"radio\" id =\"rBnOtro\" name=\"presentacion\" value=\"3\">Otro</label>";}
                else if($presentacion==3)
                {return  "<label><input type=\"radio\" id =\"rBn_Piezas\" name=\"presentacion\" value=\"1\" >Piezas/Paquete</label> <label><input type=\"radio\" id =\"rBnGranel\" name=\"presentacion\" value=\"2\" >Granel</label> <label><input type=\"radio\" id =\"rBnOtro\" name=\"presentacion\" value=\"3\" checked>Otro</label>";}
            }
            $valuePresentacion = validarPresentacion($presentacion);
    }
}else {
header("Location: Productos.php");
}
?>

<!--  Contenito HTML sobre la estructura de la pagina Gestión Productos-->

<main class="container mt-4">
    <h1>Gesti&oacute;n de Productos.</h1>
    <section class="row justify-content-md-center" >
        <div class="col-md-auto">
            <div class="col-md-auto">
            </div>
                <form class ="card" id = "form-Producto" Method="POST" action ="controlador/TratamientoDatosProducto.php" onsubmit ="ValidarRadios(this)"><!-- -->
                    <div>
                        <table >
                        <!-- Los siguientes input se asignaran valores por medio de PHP -->
                        <tr >
                            <td>
                                <label for="ipt_Codigo">C&oacute;digo de Producto</label>
                            </td>
                            <td id = "grupoCodigo"> 
                                <input type="text" id ="ipt_Codigo" name="ipt_Codigo" value = <?php echo "'".$valueCodigo."'"?>>
                            </td>
                        </tr>
                        <tr  class =" mx-auto">
                            <td>
                                <label for="ipt_Descripcion">Descripci&oacute;n</label>
                            </td>
                            <td>
                                <input type="text" id ="ipt_Descripcion" name="ipt_Descripcion" value = <?php echo "'".$valueDescripcion."'"?>>
                            </td>
                        </tr>
                        <tr  class =" mx-auto">
                            <td>
                                <label for="ipt_Presentacion">Presentaci&oacute;n</label>
                            </td>
                            <td >
                                <p >
                                    <?php echo $valuePresentacion; ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                      <table  class =" mx-auto">
                        <tr  class =" mx-auto">
                            <td>
                                <label for="ipt_Costo">Precio Costo</label>
                            </td>
                            <td>
                                <input type="number" step="0.01" id ="ipt_Costo" name="ipt_Costo" min="0"  value=<?php echo "'".$valueCosto."'"?>>
                            </td>
                            <td>
                                <label for="ipt_porcentaje">Porcentaje Ganancia</label>
                            </td>
                            <td>
                                <input type="number" id ="ipt_porcentaje" name="ipt_porcentaje"  min="0" value="20">
                            </td>
                        </tr>
                        <tr  class =" mx-auto" >
                            <td>
                                <label for="ipt_venta">Precio Venta</label>
                            </td>
                            <td>
                                <input type="number" step="0.01" id ="ipt_venta" name="ipt_venta" min="0" value=<?php echo "'".$valuePrecio."'"?>>
                            </td>
                            <td>
                                <label for="ipt_Mayoreo">Precio Mayoreo</label>
                            </td>
                            <td>
                                <input type="number" step="0.01" id ="ipt_Mayoreo" name="ipt_Mayoreo" min="0"value=<?php echo "'".$valueMayoreo."'"?>>
                            </td>
                        </tr>
                    </table>
                    <table  >
                      <datalist id="dtls_marca">
                            <!-- Contenido recuperado de la base de datos, Codigo en PHP -->
                            <?php  $marca->ConsultaGeneral();?>
                        </datalist>
                        <datalist id="dtls_proveedor">
                        <!-- Contenido recuperado de la base de datos, Codigo en PHP -->
                        <?php $proveedor->ConsultaGeneral(); ?>
                        </datalist>
                        <datalist id="dtls_departamento">
                        <!-- Contenido recuperado de la base de datos, Codigo en PHP -->
                        <?php  $departamento->ConsultaGeneral(); ?>
                        </datalist>
                        <tr  class =" mx-auto">
                            <td><label for="ipt_departamento">Departamento</label></td>
                            <td><input type="text" id ="ipt_departamento" name="ipt_departamento" list="dtls_departamento" value = <?php echo "'".$valueDepto."'"?>></td>
                            <td><label for="ipt_marca">Marca</label></td>
                            <td><input type="text" id ="ipt_marca" name="ipt_marca"list="dtls_marca" value = <?php echo "'".$valueMarca."'"?>></td>
                        </tr>
                        <tr>
                            <td><label for="ipt_proveedor">Proveedor</label></td>
                            <td><input type="text" id ="ipt_proveedor" name="ipt_proveedor" list="dtls_proveedor" value= <?php echo "'".$valueProveedor."'"?>></td>
                        </tr>
                        <br>
                        <table  class =" mx-auto" id = "">
                        <tr  class =" mx-auto" >
                            <td></td>
                            <td><button type ="submit" class ="btn btn-success" name ="btnGuardar" id ="btnGuardar" value="Guardar" >Guardar</button></td>
                            <td><button  type ="submit" class="btn btn-danger" name ="btnEliminar" id ="btnEliminar" value="Eliminar">Eliminar</button></td>
                            <td><button  type ="button" onclick ="Cancelar()"  class="btn btn-secondary" value="Cancelar">Cancelar</button></td>
                        </tr>
                        </table>
                    </div>
                   
                </form>
            <div class="col-md-auto">
            </div>
        </div>
    </section>
    
</main>
<script src="source/js/validacion.js"></script>
<?php include ("Footer.php"); ?>