<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-sm text-center c-login">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>
 <form  method="POST" action="/perfil"  enctype="multipart/form-data">
     <div class="perfil">

  <div class=" p-1">
    <?php 
    if ($_SESSION['imagen'] === null || $_SESSION['imagen'] === "") {
      ?>
      <img class="img-fluid rounded img-thumbnail oculto" id="avatar" alt="avatar" src='null' >
      <svg id="svg" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-off" width="72" height="72" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <line x1="3" y1="3" x2="21" y2="21" />
  <line x1="15" y1="8" x2="15.01" y2="8" />
  <path d="M19.121 19.122a3 3 0 0 1 -2.121 .878h-10a3 3 0 0 1 -3 -3v-10c0 -.833 .34 -1.587 .888 -2.131m3.112 -.869h9a3 3 0 0 1 3 3v9" />
  <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l5 5" />
  <path d="M16.32 12.34c.577 -.059 1.162 .162 1.68 .66l2 2" />
</svg>

      <?php
    }else {
      ?>
      <img class="img-fluid rounded img-thumbnail" id="avatar" src="<?php echo s($_SESSION['imagen']); ?>" alt="avatar">
      <?php
    }
    ?>
    
  </div>
          <label for="foto" class="form-label">Avatar</label>
          <div class="campo">
          <input type="file" id="foto" class="form-control mb-3 p-4 justify-content-center"  name="foto">
          </div>

         <div>
           <label class="form-label" for="nombre">Name</label>
           <div class="campo">
           <input class="form-control mb-3 p-4 justify-content-center" id="nombre" name="name" type="text" value="<?php echo s($usuario->name); ?>" placeholder="Tu Nombre">
         </div>
         </div>
       
       <div>
           <label class="form-label" for="email">Email</label>
           <div class="campo">
           <input class="form-control mb-3 p-4 justify-content-center" id="email" name="email" type="text" value="<?php echo s($usuario->email); ?>" placeholder="Tu email">
           </div>
       </div>
        
     </div>

     <input class="btn btn-primary p-4 loginS" type="submit" value="Save Changes">
 </form>
 <div class="acciones mt-3 flex-column">
    <a href="/cambiar-password" class="enlace">Change password</a>
    <a href="/misfotos" class="enlace">My pictures</a>
  </div>

 <a href="/logout" class="btn btn-outline-danger mt-3">logout</a>

 
</div>

<?php include_once __DIR__ . "/../layout/footer.php"; 
$script .= '<script src="build/js/perfil.js"></script>';
?>