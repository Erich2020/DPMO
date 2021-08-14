<?php
include_once ("ComunicacionDB.php");
/**
 * Archivo que contiene la clase Usuario, este es un objeto que permitira realizar operaciones 
 * con la clase ComunicacionDB, para el tratamiento de los datos. asi mismo contendra informacion en la 
 * memoria local para su procesamiento a sus metodos
 */
class Usuario{

    private  $id ;
    private  $username ;
    private  $pwd ;
    private  $id_empleado;
    private  $tipo_usuario;


    public function usuario(){

    }
    public function getId(){
        return $this->id;
    }
    public function setId($value){
        $this->id = $value;
    }
    public function getUserName(){
        return $this->username;
    }
    public function setUserName($value){
        $this->username = $value;
    }
    public function getPWD(){
        return $this->pwd;
    }
    public function setPWD($value){
        $this->pwd = $value;
    }
    public function getId_empleado(){
        return $this->id_empleado;
    }
    public function setId_empleado($value){
        $this->id_empleado = $value;
    }
    private function getTipo_Usuario(){
        return $this->tipo_usuario;
    } 
    private function setTipo_Usuario($value){
        $this->tipo_usuario = $value;
    } 


    /*
Recuparar datos y mostrarlos en una tabla

while ($fila = $resultado->fetch_assoc()) {   
    echo "<tr><th>".$fila['id']."</th><th>".$fila['nombre']."</th><th>".
	$fila['campana']."</th><th>".$fila['des']."</th></tr>";
    
}
echo "</table><br>";
echo "<a href='index.html'>Volver</a>";
*/
    public function AutenticarUsuario($user, $contra ){
        $cdb = new ComunicacionDB();
        //string $atributos, string $tabla, string $campo, string $codigo
        $result = $cdb->ConsultarXCampoValor("usuario","username", $user);
        $fila = $result->fetch_assoc();
            if(strcmp($fila['username'],$user)==0 & strcmp(sha1 ($fila['contrasena']),sha1($contra))==0){
                
                $usuarioAutenticado = new Usuario();
                $usuarioAutenticado->setUserName($fila['username']);
                $_SESSION["usuario"] = $fila['username'];
                $_SESSION["contrasena"] = sha1($fila['contrasena']);
                $_SESSION["timeout"] = time();
                 $result->free();
        $cdb->CerrarConexion();
        return true;
            }else false;
       
        
    }

}
?>