
<?php 

/**
 * Esta seccion realiza las validaciones y tratamiento para presentar los datos al usuario 
 * sin necesidad de canalizarse a otra pagina.
 * contiene el instanciamiento de las clases Departamento, Proveedor, 
 * Marca y Producto, así como del llamado al archivo HEAD.php que contiene la estructura inicial de un archivo HTML
 * En este se cuentan con algunas secciones comentadas, que se estan considerando para agregar
 *  funcionalidad y facilidad a la pagina sobre las consultas de los productos 
 */
include_once ("controlador/Producto.php");
include_once ("controlador/Marca.php");
include_once ("controlador/Proveedor.php");
include_once ("controlador/Departamento.php");
include_once ("Head.php");
$departamento = new Departamento;
$marca = new Marca;
$proveedor = new Proveedor;
$producto = new Producto;

?>

<main>
<section class="container mt-4"></section>
    <section class="container mt-4">
        <div class="container mt-4">
        <h1 >Productos</h1>
        </div>
        <div class="container mt-4">
            <form class = "card" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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

                <p class =" mt-4 mx-auto">
                    <label for="ipt_marca">Marca: </label>
                    <input type="text" name="ipt_marca" id="ipt_marca" list="dtls_marca" placeholder="Sin filtro" >

                    <label for="ipt_proveedor"> Proveedor: </label>
                    <input type="text" name="ipt_proveedor" id="ipt_proveedor" list="dtls_proveedor" placeholder="Sin filtro">
                    <label for="ipt_departamento">Departamento: </label>
                    <input type="text" name="ipt_departamento" id="ipt_departamento" list="dtls_departamento" placeholder="Sin filtro"> 
                    <input class =" btn btn-info bg-azulObscuro" type="submit" name ="filtrar" value="Filtrar">
                </p>
                <?php 
                    if(isset($_POST["filtrar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){

                        $filtroMarca = $_POST["ipt_marca"];

                        $filtroProv = $_POST["ipt_proveedor"];

                        $filtroDepto = $_POST["ipt_departamento"];

                        $DatosTabla = $producto->ConsultarEspecifica($filtroMarca, $filtroProv, $filtroDepto);
                    }else {
                        $DatosTabla = $producto->ConsultaGeneral(); 
                }
            
                    ?>
            </form>
        </div>
        <div class="container mt-4">
            <div class="container mt-4">
            <form class = "card" method = "GET" action = "gestionProductos.php" id ="formTablaProductos" onsubmit = "enviarCodigo(this)">
            <p><button class = "btn btn-info bg-azulObscuro" name ="nuevo" value = "Crear">Nuevo Producto</button></p>
                <table  class = " table-Default table-hover mx-auto" >
                    <!-- Titulos de Columnas -->
                    <thead >
                    <tr>
                        <th class ="bg-azulClaro text-color-Dark">C&oacute;digo del Producto</th>
                        <th class ="bg-azulClaro text-color-Dark">Descripci&oacute;n</th>
                        <th class ="bg-azulClaro text-color-Dark">Costo</th>
                        <th class ="bg-azulClaro text-color-Dark">Precio Unitario</th>
                        <th class ="bg-azulClaro text-color-Dark">Precio Mayoreo</th>
                        <th class ="bg-azulClaro text-color-Dark">Fecha Creacion</th>
                        <th class ="bg-azulClaro text-color-Dark">Fecha Modificaci&oacute;n</th>
                        <th class ="bg-azulClaro text-color-Dark" >Marca</th>
                        <th class ="bg-azulClaro text-color-Dark">Departamento</th>
                        <th class ="bg-azulClaro text-color-Dark">Proveedor</th>
                        <th class ="bg-azulClaro text-color-Dark">Acciones</th>
                    </tr>
                    </thead>
                    <!-- Contenido recuperado de la base de datos, Codigo en PHP -->
                    <?php echo $DatosTabla; ?>
                </table>
            </form>
            </div>
            <div>
                <!--Control de numero de datos Mostrados pagina (inicial anterior, sigiente, final)
                <form action="DataSource.php" id="f_cambioPaginaDatos">
                    <div>
                    <p class ="" id="p_cambioPaginaDatos">
                        <a id = "cambio_Inicial" >inicial</a>
                        <a id = "cambio_Anterior">anterior</a>
                        <input type="number" id="num_CambioPagina" min = "1" value="1">
                        <a id ="cambio_Siguiente">sigiente</a>
                        <a id = "cambio_Final">final</a>
                    </p>
                </div>
                </form>-->
            </div>
        </div>
      
    </section>
    
</main>
<?php include ("Footer.php"); ?>