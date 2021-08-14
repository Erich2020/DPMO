<?php
include ("ComunicacionDB.php");
/**
 * Archivo que contiene la clase Usuario, este es un objeto que permitira realizar operaciones 
 * con la clase ComunicacionDB, para el tratamiento de los datos. asi mismo contendra informacion en la 
 * memoria local para su procesamiento a sus metodos
 */
class Usuario{

    private  $username ;
    private  $pwd ;
    private  $nombre;

    private $tabla = "usuario";


    public function __Usuario(){

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
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($value){
        $this->nombre = $value;
    }

    public function AutenticarUsuario($user, $contra ){
        $cdb = new ComunicacionDB();
        $result = $cdb->ConsultarXCampoValor("usuario","username", "'".$user."'");
        $fila = $result->fetch_assoc();
            if(strcmp($fila['username'],$user)==0 & strcmp(sha1($fila['contra']), $contra)==0){
                return true;
            }else return false;
            
        $result->free();
        $cdb->CerrarConexion();
    }

    public function Registrar(){
        $cdb =  new ComunicacionDB();
        $valores = "'$this->username', '$this->nombre', '$this->pwd'";
        return $cdb->Registrar($this->tabla, $valores);
    }
}
?>