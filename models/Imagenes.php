<?php

namespace Model;

class Imagenes extends ActiveRecord{
    protected static $tabla = "imagenes";
    protected static $columnasDB = ["id", "url", "Titulo", "descripcion","usersid","aprobado"];

    public function __construct($args = [])
    {
        $this->id = $args ["id"] ?? null;
        $this->url = $args ["url"] ?? null;
        $this->Titulo = $args ["Titulo"] ?? null;       
        $this->descripcion = $args ["descripcion"] ?? null;       
        $this->usersid = $args ["usersid"] ?? null;       
        $this->aprobado = $args ["aprobado"] ?? null;       
    }
    
    public function validarTitulo()
    {
        if (!$this->Titulo) {
           self::$alertas["error"][] ="TITLE is Required";
        }
        
        return self::$alertas;
    }
    
    public function setImagen($imagen)
    {
        //Elimina imagen previa
        if (!is_null($this->id) ) {

            $this->eliminarImagen();
        }

        if ($imagen) {
            $this->url = $imagen;
        }
    }

    public function eliminarImagen()
     {
         $existe = file_exists($_SERVER["DOCUMENT_ROOT"] . $this->url);
 
             if ($existe) {
             unlink($_SERVER["DOCUMENT_ROOT"] . $this->url);    
             }
     }

     public static function alldash() {
        $query = "SELECT * FROM " . static::$tabla . " WHERE aprobado ='S' LIMIT 20";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

     public static function alldashAdministrador() {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT 20";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function FavoritasUsuario($favoritas) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id IN ( " .  
        join(", ", $favoritas)
        ." );"; 
        
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public function EliminarFotos($id)
    {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id IN ( " . join(", ", $id) . " );";
        // debuguear($query);
        $resultado = self::$db->query($query);
        if ($resultado) {
            $query = "ALTER TABLE ". static::$tabla . " AUTO_INCREMENT = 1;";
            self::$db->query($query);
            
        }
}

}