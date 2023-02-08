<?php include_once __DIR__ . "/header.php"; ?>

    <div class="contenedor">
    <?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>   
                  <div id="baner1" class="banner">
                    <picture>
                <source   srcset="build/img/34_BANNER_380px_60px_1.webp" type="image/webp">
                <img    src="build/img/34_BANNER_380px_60px_1.png" alt="Juego wifibus">
                </picture>
                </div>              
            
            
                 <div class="videos">
                 <form action="/miscupones" method="POST">
                    <input type="text" hidden name="cuponid" value="1">
                    <input type="text" hidden name="usuarioid" value="2> ">
                  <input class="cuponmas" type="submit" value="Agrega a Favoritos">
                  </form>
                  </div>
                  
            

            <div id="baner2" class="banner">
                <picture>
                <source   srcset="build/img/34_BANNER_380px_60px_2.webp" type="image/webp">
                <img    src="build/img/34_BANNER_380px_60px_2.png" alt="Juego wifibus">
                </picture>
                </div>
                
                
    </div>

<?php include_once __DIR__ . "/footer.php"; ?>

