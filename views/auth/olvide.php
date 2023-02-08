<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-sm text-center c-login">
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>
    
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
    <form  action="/olvide" method="POST">
   
        <label class="form-label" for="email">EMAIL</label>
        
        <div class="campo">
        <input class="form-control mb-3 p-4 justify-content-center" required type="email" id="email" placeholder="Tu Email" name="email" value="<?php 
        if (isset($usuario->email)) {
            echo s($usuario->email);
        }else {
            echo "";
        }        
         ?>">
    
    </div>
    <input type="submit" class="btn btn-primary p-4 loginS" value="NEW PASSWORD">
</form>

<div class="acciones uno flex-column">
    <a href="/">You already have an account or want one? LOGIN</a>
    <?php if (!empty($alertas)) {
        echo "<a href='https://mail.google.com/'>Go to your Gmail</a>
        <a href='https://outlook.live.com/'>Go to your Outlook</a>";
    }
    ?>
</div>
</div>

</div>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>