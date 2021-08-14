<?php
/**
 * Este Archivo contiene la clase ComuncacionDB, 
 * la cual permitira enlazar una comunicacion con la base de datos de MySQL
 * de tal forma que permite realizar las operacionde de leer, actualizar eliminar y crear (CRUD), esto 
 * mediante sus diversos metodos que se ajustaran segun sus donde sea instanciada 
 *  */ 
class ComunicacionDB{

    private  $host = "localhost";
    private  $usuario = "root1";
    private  $pwd = "unadmexico";
    private  $basedatos = "miscabar";
    private  $conexion_MySQL;

    public function AbrirConexion(){
        $this->conexion_MySQL =  new mysqli( $this->host,  $this->usuario,  $this->pwd, $this->basedatos);
        if( $this->conexion_MySQL->connect_errno){
            echo "Error.<br> problema de comunicaci&oacute;n con la Base de Datos.";
            echo "Error: " .  $this->conexion_MySQL->connect_error;
            exit;
        }
    }

    public function  ConsultarGeneral($tabla){
        $this->AbrirConexion();
         $query ="Select * From  $tabla";
        if(!$resultado= $this->conexion_MySQL->query($query)){
        }else {
            return $resultado;
        }
    }
    public function  ConsultarGeneralwRestric( $tabla,  $restricciones){
        $this->AbrirConexion();
        $query ="Select * From $tabla $restricciones";
        if(!$resultado= $this->conexion_MySQL->query($query)){
            return  $resultado;   
        }else {
            return $resultado;
        }
        
    }
    public function  ConsultarXCampoValor( $tabla,  $campo,  $valor){
        $this->AbrirConexion();
         $sql ="Select * From $tabla where $campo = '$valor';";
        if(!$resultado = $this->conexion_MySQL->query($sql)){
          return $resultado;
        }else{
            return $resultado;
        }
    }

    public function  ConsultarXCampoValorInt( $tabla,  $campo,  $valor){
        $this->AbrirConexion();
         $sql ="Select * From $tabla where $campo = $valor;";
        if(!$resultado = $this->conexion_MySQL->query($sql)){
          return $resultado;
        }else{
            return $resultado;
        }
    }

    public function  ConsultarEspecifica( $atributos,  $tabla,  $campo,  $codigo){
        $this->AbrirConexion();
         $query ="Selec $atributos From $tabla  Where  $campo  = '$codigo' ;";
        if(!$resultado= $this->conexion_MySQL->query($query)){
        }else {
            return $resultado;
        }
    }


    

    public function  ModificarCampo( $tabla,  $campo,  $valor, $idcampo,  $id){
        $this->AbrirConexion();
         $query ="Update $tabla Set $campo = $valor Where $idcampo = '$id' ; ";
        if(!$resultado= $this->conexion_MySQL->query($query)){
        }else {
            return $resultado;
        }
    }
    public function  ModificarCampos( $tabla,  $parCampoValor,  $idcampo,  $id){
        $this->AbrirConexion();
        $query ="Update $tabla Set $parCampoValor Where $idcampo = '$id' ; ";
        if(!$resultado= $this->conexion_MySQL->query($query)){
            echo "<p> Lo sentimos ha Ocurrido un Problema.</p>";
            echo "<br>";
        }
    }
    public function  Registrar( $tabla,  $valores){
        $this->AbrirConexion();
         $query ="Insert Into $tabla values ( $valores ) ;" ;
        if(!$resultado = $this->conexion_MySQL->query($query)){
            echo "<p> Lo sentimos ha Ocurrido un Problema.</p>";
            echo "<br>";
        }else {
            return $resultado;
        }
    }

    public function Eliminar($tabla, $campo, $pk ){
        $this->AbrirConexion();
        $query = "Delete From $tabla where $campo = '$pk' ; ";
        if(!$resultado = $this->conexion_MySQL->query($query)){
            echo "<p> Lo sentimos ha Ocurrido un Problema.</p>";
            echo "<br>";
            return $resultado;
        }else {
            return $resultado;
        }
    }
    public function CerrarConexion(){
        mysqli_close($this->conexion_MySQL);
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

}
?>