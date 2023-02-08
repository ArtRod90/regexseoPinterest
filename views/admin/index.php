<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-fluid text-center mt-5">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>
<p>photos pending approval</p>
<div class="d-grid gap-2 fotosdash justify-items-center align-items-center">
<?php
foreach ($fotos as $key => $value) {
   ?>
   <div id="C<?php echo s($value->id) ?>" style="width: 18rem; height: auto;" >
  <img src="<?php echo s($value->url); ?>" class="foto card-img-top img-fluid img-thumbnail" alt="foto"">
  <div class="card-body">
    <h5 class="card-title"><?php echo s($value->Titulo); ?></h5>
    <?php 
    foreach($todosusuarios as $key => $usuario){
        if ($value->usersid === $usuario->id) {
        ?>
    <a href="#" class="card-text"><?php echo s($usuario->name) . " " . s($usuario->email); ?></a>
    <p class="card-text">No. Warnings: <?php echo s($usuario->advertencias); ?></p>
    <?php } }?>
  </div>
  <div class="card-footer">
 
  <form  action="/adminconcurso" method="POST">
    <input id="<?php echo s($value->id) ?>" type="submit"class="aprobar btn btn-primary mt-2" value="Approve">
    </form>

    <button data-id="<?php echo s($value->id) ?>" data-idusuario="<?php
    foreach($todosusuarios as $key => $usuario){
        if ($value->usersid === $usuario->id) {
          echo s($usuario->id);
        }}
        ?>
    " class="borrar btn btn-danger mt-3" >Delete</button>
     
  </div>
</div>

   <?php 
}
?>
</div>

 </div>

<?php include_once __DIR__ . "/../layout/footer.php";  
$script .= '<script src="/build/js/admin.js"></script>'; ?>
