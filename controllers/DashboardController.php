<?php declare(strict_types = 1);

namespace Controllers;

use MVC\Router;
use Model\Imagenes;
use Model\Usuarios;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Favoritas;

class DashboardController{

    public static function index(Router $router)
    {
     session_start();
     isAuth();
    //  phpinfo(); exit;
     $alertas = []; 
     $fotos = Imagenes::alldash(); 
     $favoritas = Favoritas::belongsTo("iduser", $_SESSION["id"]);
     $numerofavoritas = Favoritas::all();
    //   debuguear($fotos);
     $router->render("dashboard/index", [
         "titulo" => "PHOTOS",
         "alertas" => $alertas,    
         "fotos" => $fotos,    
         "favoritas" => $favoritas,    
         "numerofavoritas" => $numerofavoritas    
     ]); 
    }

    public static function favoritas(Router $router)
    {
        
        session_start();
        isAuth();
        $f = [];
        $alertas = []; 
        $favoritas = Favoritas::belongsTo("iduser", $_SESSION["id"]);
    //    debuguear($favoritas);
        foreach ($favoritas as $key => $value) {
            $f[] = $value->idimagenes;
        }
        $fotos = Imagenes::FavoritasUsuario($f);
        // debuguear($fotos);
        $numerofavoritas = Favoritas::all();
       //   debuguear($fotos);
        $router->render("dashboard/favoritas", [
            "titulo" => "FAVORITES",
            "alertas" => $alertas,    
            "fotos" => $fotos,    
            "favoritas" => $favoritas,    
            "numerofavoritas" => $numerofavoritas    
        ]); 
    }

    public static function Apifavoritas()
    {
     session_start();
     isAuthAPI(); 
     
     if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $favoritas = new Favoritas;

        $existefavorito = Favoritas::existefavorita($_POST["idimagenes"], $_POST["iduser"]);
        
        if ($existefavorito) {
            $resultado = $existefavorito->eliminar();

            if ($resultado) {
                $respuesta = [
                    "resultado" => $resultado,
                    "numero" => "-"
                ];
               }else {
                $respuesta = [
                    "resultado" => $resultado,
                    "tipo" => "error",
                    "mensaje" => "error"
                ];
               }
        }else {
            $favoritas->sincronizar($_POST);
           $resultado = $favoritas->guardar();
        //    debuguear($resultado);
           if ($resultado) {
            $respuesta = [
                "resultado" => $resultado,
                "numero" => "+"
            ];
           }else {
            $respuesta = [
                "resultado" => $resultado,
                "tipo" => "error",
                "mensaje" => "error"
            ];
           }
            
        }

        echo json_encode($respuesta);
     }
     
    }

    public static function carga()
    {
     session_start();
     isAuthAPI(); 
     
     if ($_SERVER["REQUEST_METHOD"] === "POST") {

        
        $fotos = Imagenes::allcarga();
        $usuario = Usuarios::where("id", $_SESSION["id"]);
        $favoritas = Favoritas::belongsTo("iduser", $_SESSION["id"]);
        $numerofavoritas = Favoritas::all();
        $respuesta = [
            "fotos" => $fotos,
            "usuario" => $usuario,
            "favoritas" => $favoritas,
            "numerofavoritas" => $numerofavoritas
        ];
        
        echo json_encode($respuesta);
     }
     
    }
   

    public static function subir_imagen(Router $router)
    {
     session_start();
     isAuth();
     $titulo = "upload";
     $alertas = []; 
     $usuario = Usuarios::where("id", $_SESSION["id"]);
     $imagenes = new Imagenes;

     if (isset($_GET["id"])) {
      $existeimagen = Imagenes::where("id",$_GET["id"]);
      $titulo = "EDIT"; 
      if ($existeimagen) {

        if ($existeimagen->usersid === $usuario->id) {
            $imagenes = $existeimagen;
        }else {
            header("Location: /");
        }
      }else {
        header("Location: /");
      }
       
     }
        
     if ($_SERVER["REQUEST_METHOD"] === "POST") {
       
        $imagenes->sincronizar($_POST);
        $imagenes->aprobado = "N";
        $alertas = $imagenes->validarTitulo();
          
           if (empty($alertas)) {
            
            if ($imagenes->usersid === $usuario->id) {
                //SUBIR ARCHIVOS    
                if (isset($_FILES["foto"]["tmp_name"]) && $_FILES["foto"]["tmp_name"]) {
                    
                    $nombreImagen = md5(uniqid()) . ".jpg";
                    //Realiza un resize a la imagen con intervention 
                $imagen = Image::make($_FILES["foto"]["tmp_name"]);
                $imagenes->setImagen("/imagenes/" . $nombreImagen);
                
            //Crea carpeta
                if (!is_dir(CARPETA_IMAGENES)) {
                    
                    mkdir(CARPETA_IMAGENES);
                }
                
                $imagenes->Titulo = trim($imagenes->Titulo);
                $imagenes->descripcion = trim($imagenes->descripcion);
                $resultado = $imagenes->guardar();
                if ($resultado) {
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                    Imagenes::setAlerta("correcto", "SAVED SUCCESSFULLY");
                    $imagen->destroy();
                }
            
        
                    }else {
                        
                        if ($imagenes->url === null && strlen($imagenes->Titulo) > 0 && !empty($imagenes->usersid)) {
                            $obtenerurl = Imagenes::where("id",$imagenes->id);
                            $imagenes->url = $obtenerurl->url;
                            $imagenes->aprobado = $obtenerurl->aprobado;
                            $imagenes->Titulo = trim($imagenes->Titulo);
                            $imagenes->descripcion = trim($imagenes->descripcion);
                            // debuguear($imagenes);
                            $resultado = $imagenes->guardar();
                                if ($resultado) {
                                    
                                    Imagenes::setAlerta("correcto", "SAVED SUCCESSFULLY");
                                    
                                }
                            }else {
                            Imagenes::setAlerta("error", "Error uploading the Image");
                        }
                        
                        }

                     }else {
                        header("Location: /");
                     }
            }
        $alertas = Imagenes::getAlertas();
     }
    
     
    
     Imagenes::setAlerta("error", "Error uploading the Image");
     $router->render("dashboard/subir_imagen", [
         "titulo" => $titulo,
         "alertas" => $alertas,    
         "imagenes" => $imagenes,    
         "usuario" => $usuario    
     ]); 
   
    }

  

    public static function misfotos(Router $router)
    {
     session_start();
     isAuth();     
     $usuario = Usuarios::where("id", $_SESSION["id"]);     
     $alertas = [];
     $fotos = Imagenes::belongsTo("usersid", $usuario->id);
     $favoritas = Favoritas::belongsTo("iduser", $_SESSION["id"]);
     $numerofavoritas = Favoritas::all();
     $titulo = "MY PICTURES";
        
     if ($fotos) {
        $titulo = "MY PICTURES";
     }else {
        
        $titulo = "You have not added any photos";
     }

     $router->render("dashboard/misfotos", [
         "titulo" => $titulo,
         "alertas" => $alertas,   
         "fotos" => $fotos,
         "favoritas" => $favoritas,    
         "numerofavoritas" => $numerofavoritas   
     ]); 
    }

    public static function eliminarfoto()
    {
        session_start();
        isAuth();
        $f = [];
        $resultado = false;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if (isset($_POST["id"])) {

                $foto = Imagenes::where("id", $_POST["id"]); 
                $fotosfavoritas = new Favoritas;

                if ($foto->usersid === $_SESSION["id"]) {              
                     
                  $favoritas = Favoritas::belongsTo("idimagenes",$_POST["id"]);
                  foreach ($favoritas as $key => $value) {
                    $f[] = $value->id;
                }
               

                if (count($f) > 0) {
                    $resultado2 =  $fotosfavoritas->Eliminarfavoritas($f);  
                  if ($resultado2) {
                    unlink($_SERVER["DOCUMENT_ROOT"] . $foto->url );
                    $resultado = $foto->eliminar();
                  }
                }else{
                    unlink($_SERVER["DOCUMENT_ROOT"] . $foto->url );
                    $resultado = $foto->eliminar();
                }
                  
                if ($resultado) {
                    
                    $respuesta = [
                        "mensaje" => "image deleted successfully",
                        "tipo" => "success",
                        "resultado" => $resultado
                    ];
                }else {
                    $respuesta = [
                        "mensaje" => "error deleting image",
                        "tipo" => "error",
                        "resultado" => $resultado
                    ];
                }
            }else {
                $respuesta = [
                    "mensaje" => "the image does not belong to you",
                    "tipo" => "success",
                    "resultado" => $resultado
                ];
            }
        }

      
        
        echo json_encode($respuesta);
         }
    }

    
    public static function perfil(Router $router){
        
        
        session_start();
        isAuth();

        $usuario = Usuarios::find($_SESSION["id"]);
        $alertas = [];  
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario->sincronizar($_POST);

            //SUBIR ARCHIVOS     
        $nombreImagen = md5(uniqid()) . ".jpg";   
            
        if ($_FILES["foto"]["tmp_name"]) {

            // debuguear($_FILES["foto"]["tmp_name"]);
            // eliminar imagen anterior
            if ($_SESSION['imagen'] !== null ||$_SESSION['imagen'] !== "") {
                
                unlink($_SERVER["DOCUMENT_ROOT"] . $_SESSION['imagen'] );
            }
            //Realiza un resize a la imagen con intervention 
        // $imagen = Image::make($_FILES["foto"]["tmp_name"])->resize(800,600);
        $imagen = Image::make($_FILES["foto"]["tmp_name"]);
        // $imagen->fit(600);
        $imagen->fit(800, 600, function ($constraint) {
            $constraint->upsize();
        });
        $usuario->setImagen("/imagenes/" . $nombreImagen);
        $_SESSION['imagen'] = $usuario->imagen;

        //Crea carpeta
        if (!is_dir(CARPETA_IMAGENES)) {
            
            mkdir(CARPETA_IMAGENES);
        }

        $alertas = $usuario->validar_perfil();

        if (empty($alertas)) {

            $existeUsuario = Usuarios::where("email", $usuario->email);
            
            if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                Usuarios::setAlerta("error", "The email is already registered");
                $alertas = $usuario->getAlertas();
            }else{
                $usuario->guardar();

            if ($usuario) {
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                Usuarios::setAlerta("correcto", "SAVED SUCCESSFULLY");
                $alertas = $usuario->getAlertas();
                $_SESSION["name"] = $usuario->name;
                $imagen->destroy();
            }
            }
            
           
        }

        }else {
            Usuarios::setAlerta("error", "Error uploading Image");
            $alertas = Usuarios::getAlertas();

            $existeUsuario = Usuarios::where("email", $usuario->email);
                
            if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                Usuarios::setAlerta("error", "The email is already registered");
                $alertas = $usuario->getAlertas();
            }else{
                $usuario->guardar();

            if ($usuario) {
               
                Usuarios::setAlerta("correcto", "SAVED SUCCESSFULLY");
                $alertas = $usuario->getAlertas();
                
            }
            }
        }
        
           
        }
       
        $router->render("dashboard/perfil", [
            "titulo" => "PROFILE",
            "usuario" => $usuario,
            "alertas" => $alertas      
        ]); 

    }

   

    public static function cambiar_password(Router $router){
        
        session_start();
        isAuth();
        $alertas = []; 

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario = Usuarios::find($_SESSION["id"]);
            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->nuevo_password();
            
            if (empty($alertas)) {
                
                $resultado = $usuario->comprobar_password($usuario->password_actual, $usuario->password);  
                
                if ($resultado) {
                    
                    $usuario->password = $usuario->password_nuevo;
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);
                    $usuario->hashPassword();
                    $usuario->guardar();

                    if ($usuario) {
                        Usuarios::setAlerta("correcto", "Password Saved Successfully");
                        $alertas = $usuario->getAlertas();                        
                    }
                    
                }else {
                    Usuarios::setAlerta("error", "Incorrect Password");
                    $alertas = Usuarios::getAlertas();
                }

            }
        }
    
        $router->render("dashboard/cambiar-password", [
            "titulo" => "CHANGE PASSWORD",       
            "alertas" => $alertas
                
        ]); 

    }

}