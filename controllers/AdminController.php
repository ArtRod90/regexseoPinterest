<?php declare(strict_types = 1);

namespace Controllers;

use Classes\Email;
use Model\Ban;
use Model\Favoritas;
use Model\Imagenes;
use Model\Usuarios;
use MVC\Router;


class AdminController{

      public static function index(Router $router){
       
        session_start();
        isAuthAdmin();
        $alertas = [];
        $fotos = Imagenes::belongsTo("aprobado", "N");
        $todosusuarios = Usuarios::all();
        
        if ($_SESSION["privilegios"] === "1") {
            $titulo = "Administrator";
        }else{
            $titulo = "Editor";
        }
        $router->render("admin/index", [
        "titulo" => $titulo,
        "alertas" => $alertas,     
        "fotos" => $fotos,     
        "todosusuarios" => $todosusuarios     
    ]); 

    }

    public static function aprobar(){
      
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
             $concursante = Imagenes::where("id", $_POST["id"]);
             $concursante->aprobado = "S";
             $resultado = $concursante->guardar();

            if ($resultado) {
                $respuesta = [
                    "mensaje" => "The image was approved",
                    "tipo" => "success",
                    "id" => $concursante->id 
                ];
            }else {

                $respuesta = [
                    "mensaje" => "Failed to approve image",
                    "datos" => "error"
                ];
            }
            
            
        echo json_encode($respuesta); 
         }
        }

    public static function eliminar(){
      
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuariofoto = Usuarios::where("id", $_POST["idusuario"]);
            $usuariofoto->advertencias = intval($usuariofoto->advertencias) + 1;            
            
            $foto = Imagenes::where("id", $_POST["id"]);
            $favoritas = Favoritas::belongsTo("idimagenes", $foto->id);

            if (count($favoritas) > 0) {
                $f = [];
                foreach ($favoritas as $key => $value) {
                    $f[] = $value->id;
                }
               
                $foto->Eliminarfavoritas($f);
            }

            $emai = new Email($usuariofoto->email, $usuariofoto->name, $usuariofoto->token);
            $emai->enviarAviso();

            unlink($_SERVER["DOCUMENT_ROOT"] . $foto->url );
            $resultado = $foto->eliminar();
            $usuariofoto->guardar();

            if ($resultado) {
                $respuesta = [
                    "mensaje" => "The image was deleted",
                    "tipo" => "success",
                    "id" => $foto->id
                ];


            }else {

                $respuesta = [
                    "mensaje" => "error deleting image",
                    "datos" => "error"
                ];
            }
            
            
        echo json_encode($respuesta); 
         }
        }


    public static function fotos(Router $router){
        session_start();
        isAuthAdmin();
        $alertas = []; 
        $fotos = Imagenes::alldashAdministrador(); 
        $todosusuarios = Usuarios::all();
       //   debuguear($fotos);
        $router->render("admin/fotos", [
            "titulo" => "ALL PHOTOS",
            "alertas" => $alertas,    
            "fotos" => $fotos,  
            "todosusuarios" => $todosusuarios    
        ]); 
}

    public static function usuarios(Router $router){
        session_start();
        isAuthAdmin();
        $alertas = [];         
        $todosusuarios = Usuarios::belongsTo("privilegios", 3);
       //   debuguear($fotos);
        $router->render("admin/usuarios", [
            "titulo" => "ALL USERS",
            "alertas" => $alertas,    
            "todosusuarios" => $todosusuarios    
        ]); 
}

    public static function usuariosbaneados(Router $router){
        session_start();
        isAuthAdmin();
        $alertas = [];         
        $ban = Ban::all();
       //   debuguear($fotos);
        $router->render("admin/usuariosbaneados", [
            "titulo" => "ALL USERS",
            "alertas" => $alertas,    
            "ban" => $ban    
        ]); 
}

    public static function publisher(Router $router){
        session_start();
        if ($_SESSION["privilegios"] !== "1") {
            header('Location: /');
        } 
        $alertas = [];     

       if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["id"])) {
            $usuario = Usuarios::find($_POST["id"]);

            if ($usuario->privilegios === "2") {
                $usuario->privilegios = 3;
                $usuario->guardar();
                Usuarios::setAlerta("correcto", "THE EDITOR IS NOW A REGULAR USER");
              
            }else{
                Usuarios::setAlerta("error", "ERROR WHILE MAKING EDITOR REGULAR USER");
            }
        }else{
            Usuarios::setAlerta("error", "ERROR WHILE MAKING EDITOR REGULAR USER");
        }

        $alertas = $usuario->getAlertas();
       }

       $editores = Usuarios::belongsTo("privilegios", 2);
       
        $router->render("admin/editores", [
            "titulo" => "ALL PUBLISHER",
            "alertas" => $alertas,    
            "editores" => $editores    
        ]); 
}

public static function carga()
{
 session_start();
 isAuthAPI(); 
 
 if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    $fotos = Imagenes::all();
    $todosusuarios = Usuarios::all();
    $respuesta = [
        "fotos" => $fotos,
        "todosusuarios" => $todosusuarios
    ];
    
    echo json_encode($respuesta);
 }
 
}

public static function buscar()
{
 session_start();
 isAuthAPI(); 
 
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (!isset($_POST["usuario"]) || $_POST["usuario"] === "" || $_POST["usuario"] === null) {
        $respuesta = [
            "tipo" => "error",
            "mensaje" => "you must write an email",
            "usuario" => ""
        ];
    }else{
        $usuario = Usuarios::buscarusuario($_POST["usuario"]);
        $respuesta = [
            "tipo" => "success",
            "mensaje" => "user found(s)",
            "usuario" => $usuario
        ];
    }
    
    
    echo json_encode($respuesta);
 }
 
}

public static function editor()
{
 session_start();
 isAuthAPI(); 
 
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $usuario = Usuarios::where("id", $_POST["id"]);

    $usuario->privilegios = 2;
   $resultado = $usuario->guardar();

   if ($resultado) {
    $respuesta = [
        "tipo" => "success",
        "mensaje" => "new editor created successfully",
        "id" => $usuario->id
    ];

   }else{
    $respuesta = [
        "tipo" => "error",
        "mensaje" => "error changing privilege"
    ];
   }
           
    echo json_encode($respuesta);
 }
 
}

public static function ban()
{
 session_start();
 isAuthAPI(); 
 
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $f = [];
    $I = [];
    $usuario = Usuarios::where("id", $_POST["id"]);
    $banned =  new Ban();
    $banned->email = $usuario->email;
    $banned->ip = $usuario->ip;
    $usuariofavoritas = new Favoritas();
    $usuarioimagenes = new Imagenes();

   $resultado = $banned->guardar();

   if ($resultado) {


    $favoritas = Favoritas::belongsTo("iduser",$_POST["id"]);
    foreach ($favoritas as $key => $value) {
      $f[] = $value->id;
  }

    $imagenes = Imagenes::belongsTo("usersid",$_POST["id"]);
    foreach ($imagenes as $key => $value) {
      $I[] = $value->id;
  }

  if (count($f) > 0) {
    $usuariofavoritas->Eliminarfavoritas($f); 
  
  }
  if (count($I) > 0) {
    $usuarioimagenes->EliminarFotos($I);
    foreach ($imagenes as $key => $value) {
        unlink($_SERVER["DOCUMENT_ROOT"] . $value->url );
    }
    
  }

  if($usuario->imagen != null || $usuario->imagen != ""){
    unlink($_SERVER["DOCUMENT_ROOT"] . $usuario->imagen );
  }

    $respuesta = [
        "tipo" => "success",
        "mensaje" => "the user has been successfully banned",
        "id" => $usuario->id
    ];

    $usuario->eliminar();
   }else{
    $respuesta = [
        "tipo" => "error",
        "mensaje" => "error banning user"
    ];
   }
           
    echo json_encode($respuesta);
 }
 
}
}