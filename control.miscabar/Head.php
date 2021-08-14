<?php 
/**
 * En esta seccion se realizan validaciones sobre el inicio de sesion, mismos que permitiran realizar cambios
 * en la vista del usuario
 */
session_start();
$Log = "";
$menuUsuario = "";
$usuario = "";
if (!empty($_SESSION["usuario"])){
        $menuUsuario = "<li class = \"nav-item\"><a class = 'nav-link' href=\"Productos.php\">Productos</a></li>";
        $Log = "<a class = 'navbar-brand' href=\"controlador/logout.php\">Cerrar Sesión</a>";
        $usuario = "<label class = 'navbar-brand' name = \"lblNombreUsuario\">".$_SESSION["usuario"]."</label>";
        // Establecer tiempo de vida de la sesión en segundos
        $inactividad = 600;
        // Comprobar si $_SESSION["timeout"] está establecida
        if(isset($_SESSION["timeout"])){
            // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
           $sessionTTL = time() - $_SESSION["timeout"];
           if($sessionTTL > $inactividad){
               session_destroy();
               header("Location: /index.php");
           }
        }
    }else {
        $Log = "<a class = 'navbar-brand' href=\"login.php\">Iniciar Sesión</a>";
    }
?>
<!-- En este se presenta el footer o final de las paginas del sitio web
se implementa de esta forma para reutilizar codigo-->
<!DOCUMENTYPE html>
<html lang="es">
<head>
    <title>
        Control MiscAbar
    </title>
    <meta charset="utf8">
    <base href="control.miscabar">
    <link rel="icon" href="source/img/Icono.png" type="image/png" sizes="20X30">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="source/css/estilos.css">

</head>
<body class ="bg-amarillo">
<header>
    <ul class ="navbar navbar-light bg-azulClaro">
        <a href="index.php"><img class ="navbar-brand" src="source/img/LA_CONSENTIDA_Extendido.png" width = "150" heigth="50"></a>
        <?php echo $usuario ."   ". $Log;?>

</ul>
</header>
<nav class = "bg-azulObscuro">
    <ul class = "nav nav-tabs">
        <li class = "nav-item">
    <a class = " nav-link active" name ="btnIndex" href="index.php">Inicio</a>
</li>
<li class = "nav-item">
<a class = " nav-link " name ="btnIndexAcerca" href="index.php#acercade">Acerca de ...</a>
</li>
<li class = "nav-item">
<a class = "nav-link " name ="btnIndexMision" href="index.php#mision">Misi&oacuten</a>
</li>
        <?php echo $menuUsuario; ?>
    </ul>
</nav>