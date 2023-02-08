<?php

define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado

function isLogin() : void {
    if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
        header('Location: /dashboard');
    }
    }

function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
        }
    }

function isAuthAdmin() : void {

    if(!isset($_SESSION['login'])) {
        header('Location: /');              
        }
        
        if ($_SESSION["privilegios"] !== "1" && $_SESSION["privilegios"] !== "2") {
            header('Location: /');
        } 
    }

function isAuthAPI() : void {
    if(!isset($_SESSION['login'])) {
        $respuesta = [
            "mensaje" => "You have not logged in",
            "tipo" => "error"
        ];
        echo json_encode($respuesta);
        exit;
    }
}

function F04(String $numero)
{
    
    switch (strlen($numero)) {
        case 1:
            $numero = "000" . $numero;
            break;
        case 2:
            $numero = "00" . $numero;
            break;
        case 3:
            $numero = "0" . $numero;
            break;
        
        default:
            # code...
            break;
    }
    return $numero;
}

function formateoPrecio( $cantidad, string $moneda,  int $digitos, string $formato, string $decimal)
{
    $cantidad = strval($cantidad);
    $tienepunto = str_contains( $cantidad, ".");
    $tienecoma = str_contains($cantidad, ",");

    if ($tienepunto) {
        $cantidad = explode(".",$cantidad);
        $capital = array_map("strrev", array_reverse(str_split(strrev($cantidad[0]), $digitos)));
    }elseif ($tienecoma) {
        $cantidad = explode(",",$cantidad);
        $capital = array_map("strrev", array_reverse(str_split(strrev($cantidad[0]), $digitos)));
    }else {
        $capital = array_map("strrev", array_reverse(str_split(strrev($cantidad), $digitos)));
    }
          
            if (count($capital) > 1) {                
            
            $precio = $moneda . $capital[0] . $formato;

            for ($i=1; $i < count($capital); $i++) {

                if (array_key_last($capital) === $i) {

                    $precio .= $capital[$i];
                }else {

                    $precio .= $capital[$i] . $formato; 
                }                               
            }

        } else {
            $precio = $moneda . $capital[0];
        }

        if(isset($cantidad[1])){
            return $precio . $decimal . $cantidad[1];
        }else{
            return $precio . $decimal . "00";
        }
        
}