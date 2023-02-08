<?php declare(strict_types = 1);

namespace Controllers;

use Classes\Email;
use Model\Ban;
use Model\Usuarios;
use MVC\Router;


class LoginController{
    

    public static function login(Router $router){
  
        $alertas = [];
        $usuario = new Usuarios();

        session_start();
        isLogin();
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $auth = new Usuarios($_POST);
            $alertas = $auth->validarLogin();
            
            if (empty($alertas)) {
                
                $usuario = Usuarios::where("email", $auth->email);
                unset($usuario->password2);
                
                if (!$usuario || $usuario->confirmado === "0") {
                    Usuarios::setAlerta("error", "The User does not exist or is not confirmed");

                }else {

                    $resultado = $usuario->comprobar_password($_POST["password"], $usuario->password);
                    
                    if ($resultado) {
                        
                        session_start();
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["name"] = $usuario->name;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["login"] = true;
                        $_SESSION["privilegios"] = $usuario->privilegios;
                        $_SESSION["imagen"] = $usuario->imagen;
                        $_SESSION["advertencias"] = $usuario->advertencias;
                        $_SESSION["ip"] = $usuario->ip ;
                        
                        header("Location: /dashboard");
                        
                    }else {
                        Usuarios::setAlerta("error", "Incorrect Password");
                    }

                }

               
            }
         }

         $alertas =  Usuarios::getAlertas();
    $router->render("auth/login", [
        "titulo" => "login",
        "alertas" => $alertas,
        "usuario" => $usuario        
    ]); 

    }

    public static function logout(){

        session_start();
        
        $_SESSION = [];

        header("Location: /");

    }

    public static function crear(){

        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario = new Usuarios();
            $alertas = [];

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
           } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
           } else {
                $ip = $_SERVER['REMOTE_ADDR'];
           }
            $usuario->sincronizar($_POST);
            $banned = Ban::all();

            $alertas = $usuario->validarNuevaCuenta();

            foreach ($banned as $key => $value) {
                if ($value->email === $usuario->email || $ip === $value->ip) {
                    Usuarios::setAlerta("error", "you have been banned from this website you will not be able to create an account");
                }
            }
            $alertas =  Usuarios::getAlertas();
            
            if (empty($alertas)) {

            $existeUsuario = Usuarios::where("email", $usuario->email);
            
            if ($existeUsuario) {
                Usuarios::setAlerta("error", "The User is already registered");
                $alertas =  Usuarios::getAlertas();

                $respuesta = [
                    "mensaje" => $alertas["error"][0],
                    "tipo" => "error"
                ];
            
             
            echo json_encode($respuesta);     
            }else {
                
                $usuario->hashPassword();
                unset($usuario->password2);
                $usuario->token();
                $usuario->confirmado = 0;
                $usuario->privilegios = 3;
                $usuario->advertencias = 0;
                $usuario->ip = $ip;
                
                $resultado = $usuario->guardar();                                
            //    debuguear($usuario->email);
                
                if ($resultado["resultado"] === true) {
                    $email = new Email($usuario->email, $usuario->name, $usuario->token);
                $resultado = $email->enviarEmail("crear");

                    $respuesta = [
                        "mensaje" => "You have successfully registered",
                        "tipo" => "success"
                    ];
                
                 
                echo json_encode($respuesta); 
                }
            }

            }else{
                $respuesta = [
                    "mensaje" => $alertas["error"][0],
                    "tipo" => "error"
                ];
            
             
            echo json_encode($respuesta); 
            }
        }
        
        
    }

    public static function olvide(Router $router){

        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $usuario = new Usuarios($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                
                $usuario = Usuarios::where("email", $usuario->email);
                
                if ($usuario && $usuario->confirmado === "1") {
                    $usuario->token();
                    unset($usuario->password2);
                    $usuario->guardar();
                    $email = new Email($usuario->email, $usuario->name, $usuario->token);
                    $email->enviarEmail("cambiar");
                    Usuarios::setAlerta("correcto", "We have sent the instructions to your email");
                }else {
                    Usuarios::setAlerta("error", "The User does not exist or is not confirmed");
                    
                }
            }
        }

        $alertas =  Usuarios::getAlertas();

        $router->render("auth/olvide", [
            "titulo" => "forgot my password",
            "alertas" => $alertas
           
        ]); 

    }

    public static function reestablecer(Router $router){

        $token = s($_GET["token"]);

        if (!$token) {
            header("Location: /");
        }

        $usuario = Usuarios::where("token", $token);
        
        if (empty($usuario)) {
            Usuarios::setAlerta("error", "Invalid Token");
        }
        
       
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            unset($usuario->password2);
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();

            if (empty($alertas)) {
                
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();

                if ($resultado) {
                    header("Location: /");  
                }
                
            }
            
        }

        $alertas = Usuarios::getAlertas();

        $router->render("auth/reestablecer", [
            "titulo" => "Reset Password",
            "alertas" => $alertas
           
        ]);
    }

    public static function mensaje(Router $router){

        $router->render("auth/mensaje", [
            "titulo" => "Account Created Successfully"
           
        ]);
    }

    public static function confirmar(Router $router){
        $token = s($_GET["token"]);
       
        if (!$token) {
            header("Location: /");
        }

        $usuario = Usuarios::where("token", $token);

        if (empty($usuario)) {
            Usuarios::setAlerta("error", "Invalid Token");
        }else {
            //confirmar cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;

            $usuario->guardar();
            Usuarios::setAlerta("correcto", "Confirmed Account");
        }

        $alertas = Usuarios::getAlertas();
        
        $router->render("auth/confirmar", [
            "titulo" => "Password Confirmed",
            "alertas" => $alertas
           
        ]);
    }
}
