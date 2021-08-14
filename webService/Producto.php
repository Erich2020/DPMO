<?php
include ("ComunicacionDb.php");
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
    private $marca;
    private $presentacion;
    

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
        public function getMarca(){
            return $this->marca ;
        }
        public function setMarca($value){
            $this->marca = $value;
        }
        public function getPresentacion(){
            return $this->presentacion;
        }
        public function setPresentacion($value){
            $this->presentacion = $value;
        }
       
        public function ConsultaGeneral(){
            $departamento = new Departamento;
            $marca = new Marca;
            $proveedor = new Proveedor;
            $cdb =  new ComunicacionDB;
            $resultado = $cdb->ConsultarGeneral($this->tabla);
            if(!empty($resultado)){
                while ($fila = $resultado->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$fila['id']."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "<td>".$fila['presentacion']."</td>";
                echo "<td>".$fila['costo']."</td>";
                echo "<td>".$fila['precio']."</td>";
                echo "<td>".$fila['marca']."</td>";
                echo "</tr>";
                }
            }else echo "<h2>¡Lo Sentimos!. No se han Registrado Productos</h2>";
        }

    public function ConsultarEspecifica($filtroMarca, $filtroProv, $filtroDepto){
            $departamento = new Departamento;
            $marca = new Marca;
            $proveedor = new Proveedor;
            $cdb =  new ComunicacionDB;
            $restriccion1 ="";
            $restriccion2 ="";
            $restriccion3 ="";
            
            if(strcmp($filtroMarca,"")){
                $marca->ConsultarXNombre("'".$filtroMarca."'");
                $restriccion1 = "fk_idMarca = ".$marca->getId();
            } else{$restriccion1 ="";}
            if(strcmp($filtroProv,"")){
                $proveedor->ConsultarXNombre("'".$filtroProv."'");
                $restriccion2 = "fk_idProveedor = ".$proveedor->getId();
            } else{$restriccion2 ="";}
            if(strcmp($filtroDepto,"")){
                $departamento->ConsultarXNombre("'".$filtroDepto."'");
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
                echo "<tr>";
                echo "<td>".$fila['id']."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "<td>".$fila['costo']."</td>";
                echo "<td>".$fila['precio']."</td>";
                echo "<td>".$fila['mayoreo']."</td>";
                echo "<td>".$fila['fechaCreacion']."</td>";
                echo "<td>".$fila['fechaModificacion']."</td>";
                $marca->ConsultarXID($fila['fk_idMarca']);
                echo "<td>".$marca->getNombre()."</td>";
                $departamento->ConsultarXID($fila['fk_idDepartamento']);
                echo "<td>".$departamento->getNombre()."</td>";
                $proveedor->ConsultarXID($fila['fk_idProveedor']);
                echo "<td>".$proveedor->getNombre()."</td>";
                echo "<td><a href = \" \">Gestionar</a></td>";
                echo "</tr>";
            }
        }else echo "<h2>¡Lo Sentimos!. No se han Registrado Productos</h2>";
     }

    public function ConsultarXID($pk){
        $departamento = new Departamento;
        $marca = new Marca;
        $proveedor = new Proveedor;
        $cdb =  new ComunicacionDB();
        $resultado = $cdb->ConsultarGeneral($this->tabla, $this->campo,$pk);
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
        } else {echo "¡El Producto no existe!, Favor de Verificarlo.";
        echo "<p><a href = \"Productos.php\">Regresar</a></p>";}       
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
        } else {echo "<br>¡El Producto no existe!, Favor de Verificarlo.";
        echo "<p><a href = \"Productos.php\">Regresar</a></p>";}  
      
     }

    
public function Registrar(){
        $cdb =  new ComunicacionDB();
        $valores = "'$this->codigo', '$this->descripcion', $this->presentacion, $this->costo, $this->precioUnitario, '$this->marca' ";
        return $cdb->Registrar($this->tabla, $valores);
    }

    public function Modificar(){
        $departamento = new Departamento;
        $marca = new Marca;
        $proveedor = new Proveedor;
        $cdb =  new ComunicacionDB();

        $valores = "id = '$this->codigo', descripcion= '$this->descripcion', costo = $this->costo, precio = $this->precioUnitario, marca = '$this->marca', presentacion = $this->presentacion";
        $cdb->ModificarCampos($this->tabla, $valores, $this->campo,  "'$this->codigo'");
    }
    
    public function Eliminar(){
        $cdb =  new ComunicacionDB();
        $cdb->eliminar($this->tabla, $this->campo, $this->id);
    }      
    
 

}

?>