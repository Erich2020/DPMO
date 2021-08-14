<!--  Código HTML de la estructura de Login del sitio WEb -->
<?php include("Head.php");?>
<main>
    <section class="container mt-4"></section>
    <section class ="container mt-4 ">
        <div class ="row justify-content-md-center">
            <div class ="col-md-auto"></div>
            <div class ="col-md-auto">
                <!-- el tratamiento de los datos se realiza por medio de POST, 
                así mismo se llegando al servidor se encriptaran con SHA1,
                sin embargo se validara para que este encriptamiento se realice en esta seccion-->
                    <form  class ="card " method="POST" id="f_inicio_sesion" action="controlador/Autenticacion.php">
                        <p class ="mx-auto">
                            <label class ="card-subtitle mb-2 mt-4" for="usuario">Usuario</label><br>
                            <input type="text" name="usuario" id="usuario" placeholder ="Username" pattern="^[a-zA-Z0-9]{1,20}$" required>
                        </p>
                        <p class = "mx-auto">
                            <label class ="card-subtitle mb-2 mt-4" for="contrasena">Contrase&ntilde;a</label><br>
                            <input type="password" name="contrasena" id="contrasena" placeholder ="Contraseña" pattern="^[a-zA-Z0-9]{4,20}$" required>
                        </p>
                        <p class = "mx-auto" >
                            <input type="submit" id="iniciar" value="Iniciar Sesi&oacute;n">
                        </p>
                        <p class = "mx-auto"><a href="index.php">Cancelar</a></p>
                    </form>
            </div>
            <div class="col-md-auto" ></div>
        </div>
    </section>
</main>

<?php include ("Footer.php");?>