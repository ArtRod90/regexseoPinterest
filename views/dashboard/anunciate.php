<?php include_once __DIR__ . "/header.php"; ?>

    <div class="contenedor">
    <?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>   
                  
                 <div class="contenedor_anunciate">
                    <picture>
                    <source   srcset="build/img/19LOGOWifiBus.webp" type="image/webp">
                    <img    src="build/img/19LOGOWifiBus.png" alt="Juego wifibus">
                    </picture>
                              <h3>Anúnciate con Wifibus&reg</h3>
                              <p>Nuestro personal se pondrá en contacto contigo a la brevedad</p>
                          <form class="formulario_anunciate" action="/enviar" method="post">
                        
                            <label for="nombre" class="form-label">Nombre Completo<span>*</span></label>
                            <input  type="text" class="form-control" name="nombre" id="nombre" required>
                        
                            <label for="email" class="form-label">Correo electronico<span>*</span></label>
                            <input type="email" class="form-control" id="email" name="correo" placeholder="correo@ejemplo.com" required>
                        
                          <label for="asunto" class="form-label">Asunto</label>
                          <input class="form-control" id="asunto" name="asunto" required>
                        
                           <label for="mensaje" class="form-label">Mensaje<span>*</span></label>
                           <textarea id="editor" class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                        
                            <input type="submit" class="btn btn-outline-success" value="Enviar">
                        
                    </form>
                        <p>Campos con asterisco son obligatorios</p>
                  </div>                
                
    </div>

<?php include_once __DIR__ . "/footer.php";
?>
