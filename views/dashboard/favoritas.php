<?php include_once __DIR__ . "/../layout/header.php"; ?>
<div class="container-fluid text-center mt-5">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>

<div class="d-grid gap-2 fotosdash">
<?php
if (count($fotos) <= 0) { ?>
  <p>You don't have any favorite images</p>
  <?php
} else { 
foreach ($fotos as $key => $value) {
   ?>
   <div class=" " style="width: 18rem; height: auto;" >
  <img src="<?php echo s($value->url); ?>" class="foto card-img-top img-fluid img-thumbnail" alt="foto"">
  <div class="card-body">
    <h5 class="card-title"><?php echo s($value->Titulo); ?></h5>
    <p class="card-text"><?php echo s($value->descripcion); ?></p>
    
  </div>
  <div class="card-footer">
  <button data-idimagenes="<?php echo s($value->id)?>" data-iduser="<?php echo s($_SESSION["id"]); ?>" class="btnFavorito btn btn-outline-light mt-2">
  
  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler btnF <?php 
  foreach ($favoritas as $key => $S) {
    if ($S->iduser === $_SESSION["id"] && $S->idimagenes === $value->id) {
      echo "icon-tabler-fill";
    }
  }
   
  ?>" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
</svg>
<?php 
$cantidad;
$array = [];
foreach ($numerofavoritas as $key => $numero) {
  if ($numero->idimagenes === $value->id) {
    $array [] = $numero;
    
  }
}
$cantidad = count($array);
echo $cantidad;
  ?>
  </button>
  </div>
</div>

   <?php
} }
?>
</div>
 </div>
 <?php include_once __DIR__ . "/../layout/footer.php"; 
 $script .= '<script src="build/js/dashboard.js"></script>';?>



