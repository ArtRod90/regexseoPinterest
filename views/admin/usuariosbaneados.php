<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-fluid text-center mt-5">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>
<p>All ban users</p>
<!-- <form class="d-flex justify-content-center"">
        <input id="buscartxt" class="form-control me-2" type="search" placeholder="Search by email" aria-label="Search" required>
        <button id="buscar" class="btn btn-outline-success" type="submit">Search</button>
      </form>  -->
<div id="div" class="d-grid gap-2 fotosdash justify-content-center align-items-center" style="justify-items: center;">
<?php
if (count($ban) > 0 ) {
foreach ($ban as $key => $value) {
   ?> 
   <div  style="width: 10rem; height: auto;" >
   
   <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-off" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fd0061" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M14.274 10.291a4 4 0 1 0 -5.554 -5.58m-.548 3.453a4.01 4.01 0 0 0 2.62 2.65" />
  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 1.147 .167m2.685 2.681a4 4 0 0 1 .168 1.152v2" />
  <line x1="3" y1="3" x2="21" y2="21" />
</svg>

 <p>IP= <?php echo s($value->ip); ?></p>
 <p><?php echo s($value->email); ?></p>

</div>

   <?php 
}
}else{
  ?>
<p>there is no banned user</p>
  <?php
}
?>
</div>
<!-- <button id="btntcarga" type="button" class="btn btn-primary p-4 loginS mt-3">Load more</button> -->
 </div>
 <?php include_once __DIR__ . "/../layout/footer.php";
 ?>

