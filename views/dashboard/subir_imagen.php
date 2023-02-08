<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-sm text-center c-login">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

 <form  method="POST" action="/upload"  enctype="multipart/form-data">
 <input class="form-control mb-3 p-4 justify-content-center"  name="usersid" type="number" value="<?php 
     if ($imagenes->usersid === null || $imagenes->usersid === "") {
      echo s($usuario->id);
     }else {
      echo s($imagenes->usersid);
     }
      ?>" require hidden>
     <div class="perfil">
<?php
if (isset($_GET["id"])) {
?>
 <input class="form-control mb-3 p-4 justify-content-center"  name="id" type="number" value="<?php echo s($_GET["id"]);
     ?>" require hidden>
<?php } ?>
     <div class="perfil">
  <div class=" p-1">
    <?php 
    if ($imagenes->url === null || $imagenes->url === "") {
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
      <img class="img-fluid rounded img-thumbnail" id="avatar" src="<?php echo s($imagenes->url); ?>" alt="avatar">
      <?php
    }
    ?>
    
  </div>
  <?php if (!isset($_GET["id"])) {
    ?> 
          <label for="foto" class="form-label">Image</label>
          <div class="campo">
          <input type="file" id="foto" class="form-control mb-3 p-4 justify-content-center"  name="foto">
          </div>
          <?php } ?>
         <div>
           <label class="form-label" for="Title">Title</label>
           <div class="campo">
           <input class="form-control mb-3 p-4 justify-content-center" id="Title" name="Titulo" type="text" value="<?php echo s($imagenes->Titulo); ?>" placeholder="Title" require>
         </div>
         </div>
       
       <div>
           <label class="form-label" for="descripcion">description</label>
           <div class="campo">
           <textarea class="form-control mb-3 p-1 justify-content-center" cols="30" rows="5" id="descripcion" name="descripcion" type="text" placeholder="Your description"><?php echo s($imagenes->descripcion);?>
           </textarea>
           </div> 
       </div>
        
     </div>

     
     <input class="btn btn-primary p-4 loginS" type="submit" value="Save">
 </form>
 <?php if (isset($_GET["id"])) { 
  ?>
 <button id="btneliminar" class="btn btn-danger p-4 loginS" data-id="<?php echo s($_GET["id"]) ?>">Delete</button>
<?php } ?>
</div>

<?php include_once __DIR__ . "/../layout/footer.php"; 

if (isset($_GET["id"])) { 
$script .= '<script src="build/js/eliminarfoto.js"></script>';
}else {
  $script .= '<script src="build/js/perfil.js"></script>';
}
?>