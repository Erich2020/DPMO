<?php

class relacionRegistros{

private $id;
private $fk_Username;
private $fk_Codigo;
private $tabla1 ="relacionRegistros (fk_username,fk_codigo)";

public function getId(){
    return $this->id;
}

public function getfk_Username(){
    return $this->fk_Username;
}
public function setfk_Username($value){
    $this->fk_Username = $value;
}
public function setfk_Codigo($value){
    $this->fk_Codigo=$value;
}
public function getfk_Codigo(){
    return $this->fk_Codigo;
}

public function Registrar(){
    $cdb =  new ComunicacionDB();
    $valores = "'$this->fk_Username', '$this->fk_Codigo'";
    return $cdb->Registrar($this->tabla1, $valores);
}

}

?>