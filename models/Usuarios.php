<?php

namespace Model;

class Usuarios extends ActiveRecord{
    protected static $tabla = "users";
    protected static $columnasDB = ["id", "name", "email", "password", "token", "confirmado", "privilegios", "imagen",
    "advertencias", "ip"];

    public function __construct($args = [])
    {
        $this->id = $args ["id"] ?? null;
        $this->name = $args ["name"] ?? null;
        $this->email = $args ["email"] ?? null;
        $this->password = $args ["password"] ?? null;
        $this->password2 = $args ["password2"] ?? null;
        $this->password_actual = $args ["password_actual"] ?? null;
        $this->password_nuevo = $args ["password_nuevo"] ?? null;
        $this->token = $args ["token"] ?? null;
        $this->confirmado = $args ["confirmado"] ?? null;
        $this->privilegios = $args ["privilegios"] ?? null;
        $this->imagen = $args ["imagen"] ?? null;
        $this->advertencias = $args ["advertencias"] ?? null;
        $this->ip = $args ["ip"] ?? null;
    }

    public function validarLogin()
    {
      if (!$this->email) {
         self::$alertas["error"][] ="User Email is Required";
      }
      if (!$this->password) {
         self::$alertas["error"][] ="User Password is Required";
      }
      if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
         self::$alertas["error"][] = "The email is not valid";
       }

      return self::$alertas;
    }

    public function validarNuevaCuenta()
    {
        if (!$this->name) {
           self::$alertas["error"][] ="Username is Required";
        }
        if (!$this->email) {
           self::$alertas["error"][] ="User Email is Required";
        }
        if (!$this->password) {
           self::$alertas["error"][] ="User Password is Required";
        }
        if (strlen($this->password) < 6) {
           self::$alertas["error"][] ="The User's Password must contain a minimum of 6 characters";
        }
        if( $this->password !== $this->password2) {
           self::$alertas["error"][] ="The Password must be the same in both fields";
        }

        return self::$alertas;
    }

    public function hashPassword() : void
    {
         $this->password = password_hash($this->password, PASSWORD_BCRYPT ); 
    }

    public function comprobar_password(string $password, string $password_Hash) : bool
    {
       return password_verify($password, $password_Hash);
    }

    public function token() : void
    {
       $this->token = md5(uniqid());
    }

    public function validarEmail()
    {
       if (!$this->email) {
          self::$alertas["error"][] = "Email is required";
       }

       if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
         self::$alertas["error"][] = "The email is not valid";
       }
       

       return self::$alertas;
    }

    public function validarPassword() : array
    {
      if (!$this->password) {
         self::$alertas["error"][] ="User Password is Required";
      }
      if (strlen($this->password) < 6) {
         self::$alertas["error"][] ="The User's Password must contain a minimum of 6 characters";
      }

      return self::$alertas;
    }

    public function validar_perfil() : array
    {
       if (!$this->name) {
          self::$alertas["error"][] = "Name is Required";
       }

       if (!$this->email) {
          self::$alertas["error"][] = "Email is required";
       }

       return self::$alertas;
    }

    public function nuevo_password() : array
    {
       if (!$this->password_actual) {
          self::$alertas["error"][] = "The Current Password cannot be empty";
       }

       if (!$this->password_nuevo) {
          self::$alertas["error"][] = "The New Password cannot be empty";
       }

       if (strlen($this->password_nuevo) < 6) {
          self::$alertas["error"][] = "The New Password must be a minimum of 6 characters";
       }

       return self::$alertas;
    }

    public static function buscarusuario($buscar){
      $query = "SELECT * FROM " . static::$tabla . " WHERE privilegios='3' AND email LIKE '%" . $buscar . "%' LIMIT 20;";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
      
}