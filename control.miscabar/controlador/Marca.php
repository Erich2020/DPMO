<?php
include_once ("ComunicacionDB.php");
/**
 * Archivo que contiene la clase Marca, este es un objeto que permitira realizar operaciones 
 * con la clase ComunicacionDB, para el tratamiento de los datos. asi mismo contendra informacion en la 
 * memoria local para su procesamiento a sus metodos
 */
class Marca{

    private $id;
    private $nombre;

    private $tabla = "marca";
    private $campo = "id";

    public function __Marca (){

    }

    public function getId(){
        return $this->id;
    }
    public function setId($value){
        $this->id = $value;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($value){
        $this->nombre = $value;
    }
    public function ConsultarXID($pk){
        $cdb =  new ComunicacionDB();
        $resultado = $cdb->ConsultarXCampoValorint($this->tabla, $this->campo, $pk);
        if(!empty($resultado))
        {
            $fila = $resultado->fetch_assoc();
            $this->id = $pk;
            $this->nombre = $fila['nombre'];
        }
    }

    public function ConsultarXNombre($name){
        $cdb =  new ComunicacionDB();
        $resultado = $cdb->ConsultarXCampoValor($this->tabla, "nombre", $name);
        
        if(!empty($resultado))
        {
            $resultado = $resultado->fetch_assoc();
            $this->id = $resultado['id'];
            $this->nombre = $name;
        } 
        return $resultado;
    }


    public function ConsultaGeneral(){
        $cdb = new ComunicacionDB;
        $resultado = $cdb->ConsultarGeneral($this->tabla);
        if(!empty($resultado))
        {while ($fila = $resultado->fetch_assoc()){
            echo "<option value = \"".$fila['nombre']."\" label ='".$fila['id']."'></option>";
        }

        }
        else {
            echo "campo vacio!";
        }

    }

    public function registrar(){
        $cdb =  new ComunicacionDB();
        $resultado = $cdb->ConsultarGeneral($this->tabla);
        $this->id = $resultado->num_rows + 1; 
        $valores = "$this->id, '$this->nombre' ";
        $cdb->Registrar($this->tabla, $valores);
    }

    public function modificar(){
        $cdb =  new ComunicacionDB();
        $valores = "id=$this->id, nombre= '$this->nombre'"; 
        $cdb->ModificarCampos($this->tabla, $valores, $this->campo,  $this->id);
    }
    
    public function eliminar(){
        $cdb =  new ComunicacionDB();
        $cdb->eliminar($this->tabla, $this->campo, $this->id);
    }

}


?>