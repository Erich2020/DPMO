<?php
//include_once ("ComunicacionDB.php");
/**
 * Este archivo contiene una de las clases principales, la cual realiza el tratamiento de los datos de
 * producto, la cual instancia la clase ComunicacionDB para realizar las diversas 
 * operaciones del CRUD con la base de datos.
 * 
 */



class Producto {

    private $codigo;
    private $descripcion;
    private $costo;
    private $precioUnitario;
    private $precioMayoreo;
    private $fechaCreacion;
    private $fechaModificacion;
    private $fk_idDepartamento;
    private $fk_idProveedor;
    private $fk_idMarca;
    private $fk_presentacionProducto;
    
  

    private $tabla ="producto";
    private $campo ="id";

    public function __Producto(){

        }
        public function getCodigo(){
            return $this->codigo;
        }
        public function setCodigo($value){
            $this->codigo = $value;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($value){
            $this->descripcion = $value;
        }

        public function getCosto(){
            return $this->costo ;
        }
        public function setCosto($value){
            $this->costo = $value;
        }

        public function getPrecioUnitario(){
            return $this->precioUnitario;
        }
        public function setPrecioUnitario($value){
            $this->precioUnitario = $value;
        }
        public function getPrecioMayoreo(){
            return $this->precioMayoreo;
        }
        public function  setPrecioMayoreo($value){
            $this->precioMayoreo = $value;
        }
        public function getFechaCreacion(){
            return $this->fechaCreacion;
        }
        public function setFechaCreacion($value){
            $this->fechaCreacion = $value;
        }
        public function getFechaModificacion(){
            return $this->fechaModificacion ;
        }
        public function setFechaModificacion($value){
            $this->fechaModificacion = $value;
        }

        public function getFk_idDepartamento(){
            return $this->fk_idDepartamento ;
        }
        public function setFk_idDepartamento($value){
            $this->fk_idDepartamento = $value;
        }

        public function getFk_idProveedor(){
            return $this->fk_idProveedor;
        }

        public function setFk_idProveedor($value){
            $this->fk_idProveedor = $value;
        }

        public function getFk_idMarca(){
            return $this->fk_idMarca;
        }

        public function setFk_idMarca($value){
            $this->fk_idMarca =$value;
            
        }
        public function getFk_presentacionProducto(){
            return $this->fk_presentacionProducto;
        }
        public function setFk_presentacionProducto($value){
            $this->fk_presentacionProducto = $value;
        }
       
        public function ConsultaGeneral(){
            $departamento = new Departamento;
            $marca = new Marca;
            $proveedor = new Proveedor;
            $cdb =  new ComunicacionDB;
            $consulta = "";
            $resultado = $cdb->ConsultarGeneral($this->tabla);
            if(!empty($resultado)){
                while ($fila = $resultado->fetch_assoc()){
                $consulta = $consulta. "<tr>";
                $consulta = $consulta."<td>".$fila['id']."</td>";
                $consulta = $consulta. "<td>".$fila['descripcion']."</td>";
                $consulta = $consulta. "<td> $".$fila['costo']."</td>";
                $consulta = $consulta. "<td> $".$fila['precio']."</td>";
                $consulta = $consulta. "<td> $".$fila['mayoreo']."</td>";
                $consulta = $consulta. "<td>".$fila['fechaCreacion']."</td>";
                $consulta = $consulta. "<td>".$fila['fechaModificacion']."</td>";
                $marca->ConsultarXID($fila['fk_idMarca']);
                $consulta = $consulta. "<td>".$marca->getNombre()."</td>";
                $departamento->ConsultarXID($fila['fk_idDepartamento']);
                $consulta = $consulta. "<td>".$departamento->getNombre()."</td>";
                $proveedor->ConsultarXID($fila['fk_idProveedor']);
                $consulta = $consulta. "<td>".$proveedor->getNombre()."</td>";
                $consulta = $consulta. "<td><button type ='submit' name = 'codigo' Value = '".$fila['id']."'>Gestionar</button></td>";
                $consulta = $consulta. "</tr>";
                }
            }else {
            $consulta = "<h2>¡Lo Sentimos!. No se han Registrado Productos</h2>";
            }
            return $consulta;
        }

    public function ConsultarEspecifica($filtroMarca, $filtroProv, $filtroDepto){
            $departamento = new Departamento;
            $marca = new Marca;
            $proveedor = new Proveedor;
            $cdb =  new ComunicacionDB;
            $restriccion1 ="";
            $restriccion2 ="";
            $restriccion3 ="";
            $consulta = "";
            if(strcmp($filtroMarca,"")){
                $marca->ConsultarXNombre($filtroMarca);
                $restriccion1 = "fk_idMarca = ".$marca->getId();
            } else{$restriccion1 ="";}
            if(strcmp($filtroProv,"")){
                $proveedor->ConsultarXNombre($filtroProv);
                $restriccion2 = "fk_idProveedor = ".$proveedor->getId();
            } else{$restriccion2 ="";}
            if(strcmp($filtroDepto,"")){
                $departamento->ConsultarXNombre($filtroDepto);
                $restriccion3 = "fk_idDepartamento = ".$departamento->getId();
            } else{$restriccion3 ="";}

            if(strcmp($restriccion1,"")){
                $restriccion = " Where ".$restriccion1;
                if(strcmp($restriccion2,"")){
                    $restriccion = $restriccion." and ".$restriccion2;
                    if(strcmp($restriccion3,"")){
                        $restriccion = $restriccion." and ".$restriccion3;
                    }        
                }else if(strcmp($restriccion3,"")){
                    $restriccion = $restriccion." and ".$restriccion3;
                }
            }else if(strcmp($restriccion2,"")){
                $restriccion = " Where ".$restriccion2;
                if(strcmp($restriccion3,"")){
                    $restriccion = $restriccion." and ".$restriccion3;
                }
            }else if(strcmp($restriccion3,"")){
                $restriccion = " Where ".$restriccion3;
            }else{
                $restriccion = ";";
            }
            $resultado = $cdb->ConsultarGeneralwRestric($this->tabla, $restriccion);
        if(!empty($resultado)){
            while ($fila = $resultado->fetch_assoc()){
                $consulta = $consulta."<tr>";
                $consulta = $consulta. "<td>".$fila['id']."</td>";
                $consulta = $consulta. "<td>".$fila['descripcion']."</td>";
                $consulta = $consulta. "<td> $ ".$fila['costo']."</td>";
                $consulta = $consulta. "<td> $ ".$fila['precio']."</td>";
                $consulta = $consulta. "<td> $ ".$fila['mayoreo']."</td>";
                $consulta = $consulta. "<td>".$fila['fechaCreacion']."</td>";
                $consulta = $consulta."<td>".$fila['fechaModificacion']."</td>";
                $marca->ConsultarXID($fila['fk_idMarca']);
                $consulta = $consulta. "<td>".$marca->getNombre()."</td>";
                $departamento->ConsultarXID($fila['fk_idDepartamento']);
                $consulta = $consulta. "<td>".$departamento->getNombre()."</td>";
                $proveedor->ConsultarXID($fila['fk_idProveedor']);
                $consulta = $consulta. "<td>".$proveedor->getNombre()."</td>";
                $consulta = $consulta. "<td><button type ='submit' name = 'codigo' Value = '".$fila['id']."'>Gestionar</button></td>";
                $consulta = $consulta."</tr>";
            }
        }else $consulta = "<h2>¡Lo Sentimos!. No se han Registrado Productos</h2>";
    return $consulta;
    }

    public function ConsultarXID($pk){
        $departamento = new Departamento;
        $marca = new Marca;
        $proveedor = new Proveedor;
        $cdb =  new ComunicacionDB();
        $resultado = $cdb->ConsultarXCampoValor($this->tabla, $this->campo, $pk);
        if(!empty($resultado)){
            $fila = $resultado->fetch_assoc();
                $this->codigo = $fila["id"];
                $this->descripcion = $fila["descripcion"];
                $this->costo = $fila["costo"];
                $this->precioUnitario = $fila["precio"];
                $this->precioMayoreo = $fila["mayoreo"];
                $this->fechaCreacion = $fila["fechaCreacion"];
                $this->fechaModificacion = $fila["fechaModificacion"];
                $departamento->ConsultarXID($fila["fk_idDepartamento"]);
                $this->fk_idDepartamento = $departamento->getNombre();
                $proveedor->ConsultarXID($fila["fk_idProveedor"]);
                $this->fk_idProveedor = $proveedor->getNombre();
                $marca->ConsultarXID($fila["fk_idMarca"]);
                $this->fk_idMarca = $marca->getNombre();
                $this->fk_presentacionProducto = $fila["fk_presentacionProducto"];
        } else {
            echo "¡El Producto no existe!, Favor de Verificarlo.";
            echo "<p><a href = \"../Productos.php\">Regresar a P&aacute;gina Productos</a></p>";
        } 
        return $resultado;      
    }

    public function ConsultarXNombre($name){
        $departamento = new Departamento;
        $marca = new Marca;
        $proveedor = new Proveedor;
        $cdb =  new ComunicacionDB();
        $resultado = $cdb->ConsultarXCampoValor($this->tabla, "nombre", $name);

        if(!empty($resutado)){
            while($fila = $resultado->fetch_assoc()){
                $this->codigo = $fila["id"];
                $this->descripcion = $fila["descripcion"];
                $this->costo = $fila["costo"];
                $this->precioUnitario = $fila["precio"];
                $this->precioMayoreo = $fila["mayoreo"];
                $this->fechaCreacion = $fila["fechaCreacion"];
                $this->fechaModificacion = $fila["fechaModificacion"];
                $departamento->ConsultarXID($fila["fk_idDepartamento"]);
                $this->fk_idDepartamento = $departamento->getNombre();
                $proveedor->ConsultarXID($fila["fk_idProveedor"]);
                $this->fk_idProveedor = $proveedor->getNombre();
                $marca->ConsultarXID($fila["fk_idMarca"]);
                $this->fk_idMarca = $marca->getNombre();
                $presentacion = $cdb->ConsultarXCampoValor("presentacionProducto","id", $fila["fk_presentacionProducto"])->fetch_assoc();
                $this->fk_presentacionProducto = $presentacion["descripcion"];
            }
            return true;
        } else {
            echo "<br>¡El Producto no existe!, Favor de Verificarlo.";
        echo "<p><a href = .\"Productos.php\">Regresar</a></p>";
        return false;}  
      
    }

    public function Registrar(){
        $cdb =  new ComunicacionDB();
        $fmodificar = date ( "Ymd" , time());
        $valores = "'$this->codigo', '$this->descripcion', $this->costo, $this->precioUnitario, $this->precioMayoreo, '$fmodificar', '$fmodificar', $this->fk_idDepartamento, $this->fk_idProveedor, $this->fk_idMarca, $this->fk_presentacionProducto";
        $cdb->Registrar($this->tabla, $valores);
    }

    public function Modificar(){
        $departamento = new Departamento;
        $marca = new Marca;
        $proveedor = new Proveedor;
        $cdb =  new ComunicacionDB();
        $fmodificar = date ( "Ymd" , time());

        $valores = " id = '$this->codigo', descripcion= '$this->descripcion', costo = $this->costo, precio = $this->precioUnitario, mayoreo = $this->precioMayoreo, fechaCreacion ='$this->fechaCreacion', fechaModificacion = '$fmodificar', fk_idDepartamento = ".$this->fk_idDepartamento.", fk_idProveedor = ".$this->fk_idProveedor.", fk_idMarca = ".$this->fk_idMarca.", fk_presentacionProducto = $this->fk_presentacionProducto ";
        $cdb->ModificarCampos($this->tabla, $valores, $this->campo,  $this->codigo);
    }
    
    public function Eliminar(){
        $cdb =  new ComunicacionDB();
        $cdb->Eliminar($this->tabla, $this->campo, $this->codigo);
    }


     /* 
         private $fk_idDepartamento;
    private $;
    private $;
     
     public function ConsultarXID($pk){
            $cdb =  new ComunicacionDB();
            $cdb->ConsultarGeneral($tabla, $campo,$pk);
            $this->id = $pk;
            $this->$nombre;
        }
    
        public function ConsultarXNombre($name){
            $cdb =  new ComunicacionDB();
            $cdb->ConsultarXCampoValor($tabla, "nombre",$name);
            $this->id = $pk;
            $this->$nombre;

        }
    
    */
        
    
 

}

?>