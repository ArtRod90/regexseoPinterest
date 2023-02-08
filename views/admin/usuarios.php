<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-fluid text-center mt-5">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>
<p>Manager all users</p>
<form class="d-flex justify-content-center mb-3"">
        <input id="buscartxt" class="form-control me-2" type="search" placeholder="Search by email" aria-label="Search" required>
        <button id="buscar" class="btn btn-outline-success" type="submit">Search</button>
      </form> 
<div id="div" class="d-grid gap-2 fotosdash justify-content-center align-items-center" style="justify-items: center;">
<?php
foreach ($todosusuarios as $key => $value) {
   ?> 
   <div id="C<?php echo s($value->id) ?>" style="width: 10rem; height: auto;" >
   <?php if ($value->imagen === null || $value->imagen === "") {
    ?>
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="12" cy="7" r="4" />
  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
</svg>
<?php
   }else{
        ?>
         <img src="<?php echo s($value->imagen); ?>" class="rounded-circle img-fluid img-thumbnail" alt="foto"">
         <?php
   } ?>
 <p><?php echo s($value->name); ?></p>
 <a href="#"><?php echo s($value->email); ?></a>
 <?php if ($_SESSION["privilegios"] == 1) {
   ?>
  <button class="make btn btn-primary mt-3" data-id="<?php echo s($value->id) ?>">Make editor</button>
  <?php
 } ?>
 
 <button class="ban btn btn-danger mt-3" data-id="<?php echo s($value->id) ?>">Ban</button>
</div>

   <?php 
}
?>
</div>
<!-- <button id="btntcarga" type="button" class="btn btn-primary p-4 loginS mt-3">Load more</button> -->
 </div>
 <?php include_once __DIR__ . "/../layout/footer.php"; 
 $script .= '<script src="/build/js/buscar.js"></script>';
 $script .= '<script src="/build/js/adminusuarios.js"></script>';
 ?>

