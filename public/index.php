<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use MVC\Router;
use Controllers\JuegoController;
use Controllers\LoginController;
use Controllers\TareasController;
use Controllers\DashboardController;

$router = new Router();

  //Paginas
  $router->get("/dashboard", [DashboardController::class, "index"]);
  $router->post("/dashboard", [DashboardController::class, "index"]);
  $router->get("/upload", [DashboardController::class, "subir_imagen"]);  
  $router->post("/upload", [DashboardController::class, "subir_imagen"]);
  $router->get("/favoritas", [DashboardController::class, "favoritas"]);
  $router->get("/misfotos", [DashboardController::class, "misfotos"]);
  $router->post("/misfotos", [DashboardController::class, "misfotos"]);
  
  //ADMIN
  $router->get("/admin/home", [AdminController::class, "index"]);
  $router->get("/admin/fotos", [AdminController::class, "fotos"]);
  $router->get("/admin/usuarios", [AdminController::class, "usuarios"]);
  $router->get("/admin/ban", [AdminController::class, "usuariosbaneados"]);
  $router->get("/admin/publisher", [AdminController::class, "publisher"]);
  $router->post("/admin/publisher", [AdminController::class, "publisher"]);

  // Login y Autenticacion
  $router->get("/", [LoginController::class, "login"]);
  $router->post("/", [LoginController::class, "login"]);
  $router->get("/logout", [LoginController::class, "logout"]);

  // Crear
  $router->post("/crear", [LoginController::class, "crear"]);

  // Formulario de olvide mi password
  $router->get("/olvide", [LoginController::class, "olvide"]);
  $router->post("/olvide", [LoginController::class, "olvide"]);

  // Nuevo password  
  $router->get("/reestablecer", [LoginController::class, "reestablecer"]);
  $router->post("/reestablecer", [LoginController::class, "reestablecer"]);
  
  
  
  // Confirmacion Cuenta
  $router->get("/mensaje", [LoginController::class, "mensaje"]);  
  $router->get("/confirmar", [LoginController::class, "confirmar"]);  
  $router->get("/reestablecer", [LoginController::class, "reestablecer"]);
  $router->post("/reestablecer", [LoginController::class, "reestablecer"]);
  
    
//ZONA DE Perfil
$router->get("/perfil", [DashboardController::class, "perfil"]);
$router->post("/perfil", [DashboardController::class, "perfil"]);
$router->get("/cambiar-password", [DashboardController::class, "cambiar_password"]);
$router->post("/cambiar-password", [DashboardController::class, "cambiar_password"]);

//API

$router->post("/api/aprobar", [AdminController::class, "aprobar"]);
$router->post("/api/eliminar", [AdminController::class, "eliminar"]);
$router->post("/api/editor", [AdminController::class, "editor"]);
$router->post("/api/ban", [AdminController::class, "ban"]);
$router->post("/admin/carga", [AdminController::class, "carga"]);
$router->post("/admin/buscar", [AdminController::class, "buscar"]);
$router->post("/api/favoritas", [DashboardController::class, "Apifavoritas"]);
$router->post("/api/carga", [DashboardController::class, "carga"]);
$router->post("/api/eliminarfoto", [DashboardController::class, "eliminarfoto"]);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();