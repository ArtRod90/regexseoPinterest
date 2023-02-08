<?php

namespace Model;

class Favoritas extends ActiveRecord{
    protected static $tabla = "favoritas";
    protected static $columnasDB = ["id", "idimagenes", "iduser"];

    public function __construct($args = [])
    {
        $this->id = $args ["id"] ?? null;
        $this->idimagenes = $args ["idimagenes"] ?? null;     
        $this->iduser = $args ["iduser"] ?? null;       
    }
    
    public static function existefavorita($idimagenes, $iduser) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE idimagenes = '${idimagenes}' AND iduser = '${iduser}' ;"; 
            
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    
    public function Eliminarfavoritas($id)
    {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id IN ( " . join(", ", $id) . " );";
        // debuguear($query);
        $resultado = self::$db->query($query);
        if ($resultado) {
            $query = "ALTER TABLE ". static::$tabla . " AUTO_INCREMENT = 1;";
            self::$db->query($query);
            
        }
        
            return $resultado;
    }
}