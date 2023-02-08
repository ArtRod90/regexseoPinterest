<?php

namespace Model;

class Ban extends ActiveRecord{
    protected static $tabla = "banned";
    protected static $columnasDB = ["id",  "email", "ip"];

    public function __construct($args = [])
    {
        $this->id = $args ["id"] ?? null;
        $this->email = $args ["email"] ?? null;
        $this->ip = $args ["ip"] ?? null;
    }

    
      
}