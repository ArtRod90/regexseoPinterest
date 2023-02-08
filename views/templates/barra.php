
<div class="barra" id="barra">

    <div class="barra_idioma">
    <p class="comunicacion">Comunicación En Movimineto</p>
    </div>

    <div class="contenedor_barra">

<div class="barra_logo">
    <a href="/">
        <picture>
            <source   srcset="build/img/19LOGOWifiBus.webp" type="image/webp">
            <img  src="build/img/19LOGOWifiBus.png" alt="logo">
        </picture>
    </a>
    
</div>    
         
    <div class="contenedor_botones">

        <div class="botones_barra">
            
            <div class="botones_nav">

            <div id="tendencia">
                    <a href="/tendencias">
                    <picture>
                            <source   srcset="build/img/BOTON_tendencias.webp" type="image/webp">
                            <img  src="build/img/BOTON_tendencias.png" alt="tendencia">
                            </picture>
                    </a>                  
                </div>      

                        <div id="Entretenimiento">
                            <a href="/entretenimiento">
                            <picture>
                        <source   srcset="build/img/BOTON_entretente.webp" type="image/webp">
                        <img  src="build/img/BOTON_entretente.png" alt="contacto">
                        </picture>
                            </a>
                  
                        </div>

                        <div id="cupones-barra">
                            <a href="/cupones">
                            <picture>
                        <source   srcset="build/img/BOTON_cupones.webp" type="image/webp">
                        <img  src="build/img/BOTON_cupones.png" alt="cupones">
                        </picture>
                        </a>
                        </div>

                        <div id="juego">                       
                  <a href="/juego">
                  <picture>
                        <source   srcset="build/img/BOTON_jugar.webp" type="image/webp">
                        <img  src="build/img/BOTON_jugar.png" alt="juego">
                        </picture>
                </a>
                        </div>

                        <div id="aunciate">
                            <a href="/anunciate">
                            <picture>
                        <source   srcset="build/img/BOTON_anunciate.webp" type="image/webp">
                        <img  src="build/img/BOTON_anunciate.png" alt="anunciate">
                        </picture>
                            </a>
                  
                        </div>
            </div>
        
        </div>

        <div class="session_barras">
        <?php
                if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
                    ?>
                    <div class="saludo">

                        <div>
                        <p>Hola: <span><?php if (isset($_SESSION["name"])) {
                        echo s($_SESSION["name"]);
                        ?></span></p>
                        </div>
                        <?php
        }
        ?>
        <div class="hamburguesa" >
        <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <polyline points="6 9 12 15 18 9" />
        </svg>

        <ul>
                <li><a href="/perfil" class="cerrar-session">Perfil</a></li>
                <li><a href="/cambiar-password" class="cerrar-session">Cambiar Password</a></li>
                <li><a href="/miscupones" class="cerrar-session">Mis Cupones</a></li>
                <li><a href="/logout" class="cerrar-session">Cerrar Session</a></li>                
            </ul>
        </div>
           
            </div>
            
            <?php
                }else {
                    ?>
                    <a href="/login" class="cerrar-session">Iniciar sesión / Crear cuenta</a>
                    <?php
                } ?>

                <div class="botones_red">

                <div class="picture">
                <a href="https://www.facebook.com/WifiBusCDMX" target="_blank"><picture>
                    <source   srcset="build/img/ICONO_FACEBOOK_gris.webp" type="image/webp">
                    <img  src="build/img/ICONO_FACEBOOK_gris.png" alt="facebook">
                </picture></a>
                </div>

                <div class="picture">
                <a href="https://api.whatsapp.com/send?phone=5524945801" target="_blank"><picture>
                    <source   srcset="build/img/ICONO_WHATSAPP_gris.webp" type="image/webp">
                    <img  src="build/img/ICONO_WHATSAPP_gris.png" alt="whatsapp">
                </picture></a>
                </div>    

                <div class="picture">
                <a href="mailto:info@wifibus.mx?Subject" target="_blank"><picture>
                    <source   srcset="build/img/ICONO_MAIL_gris.webp" type="image/webp">
                    <img  src="build/img/ICONO_MAIL_gris.png" alt="email">
                </picture></a> 
                </div>

              </div>

        </div>
    </div>    
  </div>
</div>