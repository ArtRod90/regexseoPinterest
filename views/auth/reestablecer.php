<?php include_once __DIR__ . "/../layout/header.php"; ?>
<div class="container-sm text-center c-login">

<div class="contenedor-sm">
<h1 class="text-light">NEW PASSWORD</h1
    <p class="descripcion-pagina">ENTER YOUR NEW PASSWORD</p>
    <?php include_once __DIR__ . "/../templates/alertas.php"; 
        if (empty($alertas)) {
            ?>
<form  method="POST">
   
       <label class="form-label" for="password">Password</label>
       <div class="campo">
       <input required class="form-control mb-3 p-4 justify-content-center" type="password" id="password" placeholder="your Password" name="password">
   </div>    
   
   <input type="submit" class="btn btn-primary p-4 loginS" value="SAVE PASSWORD">
</form>
       <?php }?>
    
    

<div class="acciones uno flex-column">    
    <a href="/crear">You already have an account or want one? LOGIN</a>
</div>
</div>

</div>