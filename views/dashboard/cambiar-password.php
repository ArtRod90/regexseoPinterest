<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-sm text-center c-login">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>
 
<?php include_once __DIR__ . "/../templates/alertas.php"; ?>
 <form  method="POST" action="/cambiar-password">
     
        
           <label class="form-label" for="password_actual">Current Password</label>
           <div class="campo">
           <input class="form-control mb-3 p-4 justify-content-center" id="password_actual" name="password_actual" type="password" placeholder="Your Password">
         </div>

           <label class="form-label"for="password_nuevo">New Password</label>
           <div class="campo">
           <input class="form-control mb-3 p-4 justify-content-center" id="password_nuevo" name="password_nuevo" type="password" placeholder="New Password">
           
       </div>
     <input class="btn btn-primary p-4 loginS" type="submit" value="Save Changes">
 </form>

 <div class="enlace mt-3">
 <a href="/perfil" >back to profile</a>
 </div>
</div>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>