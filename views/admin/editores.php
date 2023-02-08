<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-fluid text-center mt-5">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>
<p>All publisher</p>
<!-- <form class="d-flex justify-content-center"">
        <input id="buscartxt" class="form-control me-2" type="search" placeholder="Search by email" aria-label="Search" required>
        <button id="buscar" class="btn btn-outline-success" type="submit">Search</button>
      </form>  -->
      <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
<div id="div" class="d-grid gap-2 fotosdash justify-content-center align-items-center" style="justify-items: center;">
<?php
if (count($editores) > 0 ) {
foreach ($editores as $key => $value) {
   ?> 
   <div  style="width: 10rem; height: auto;" >
   
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

 <p>IP= <?php echo s($value->ip); ?></p>
 <p><?php echo s($value->name); ?></p>
 <p><?php echo s($value->email); ?></p>

 <form action="/admin/publisher" method="POST">
    <input type="text" name="id" value="<?php echo s($value->id) ?>" hidden>
<input type="submit" class="ban btn btn-danger mt-3" require value="Make regular user">
</form>
</div>


   <?php 
}
}else{
  ?>
<p>there is no publisher</p>
  <?php
}
?>
</div>
<!-- <button id="btntcarga" type="button" class="btn btn-primary p-4 loginS mt-3">Load more</button> -->
 </div>
 <?php include_once __DIR__ . "/../layout/footer.php";
 ?>

