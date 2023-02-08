<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container-sm text-center c-login"> 
<?php include_once __DIR__ . "/../templates/nombre-pagina.php"; ?>
    
        <nav>
    <ul class="pagination pagination-lg justify-content-center">
        <li id="signin" class="page-item active"><a class="page-link" href="#">SIGN IN</a></li>
        <li id="signup"  class="page-item"><a class="page-link" href="#">SING UP</a></li>
    </ul>
    </nav>
    
    
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
    <div id="loginsignin">
    <form action="/" method="POST">
    
        <label class="form-label" for="email">Email</label>
        <div class="campo">
        <input class="form-control mb-3 p-4 justify-content-center" type="email" id="email" placeholder="your Email" name="email" value="<?php 
        if (isset($usuario->email)) {
            echo s($usuario->email);
        }else {
            echo "";
        }        
         ?>">
    </div>
    
        <label class="form-label" for="password">Password</label>
        <div class="campo">
        <input class="form-control mb-3 p-4 justify-content-center" type="password" id="password" placeholder="your Password" name="password">
    </div>
    <input class="btn btn-primary p-4 loginS" type="submit" class="boton" value="SING IN">
</form>
</div>

<div id="loginsignup" class="oculto">
<form  action="/crear" method="POST">
    
        <label class="form-label" for="nombre">Name</label>
        <div class="campo">
        <input class="form-control mb-3 p-4 justify-content-center" required type="text" id="nombre" placeholder="your Name" name="name" value="<?php if (isset($usuario->name)) {
            echo s($usuario->name);
        }else {
            echo "";
        } ?>">
         </div>
     
        <label class="form-label" for="email1">Email</label>
        <div class="campo">
        <input class="form-control mb-3 p-4 justify-content-center" required type="email" id="email1" placeholder="your Email" name="email" value="<?php if (isset($usuario->email)) {
            echo s($usuario->email);
        }else {
            echo "";
        }?>">
        </div>
    
        <label class="form-label" for="password1">Password</label>
        <div class="campo">
        <input class="form-control mb-3 p-4 justify-content-center" required type="password" id="password1" placeholder="your Password" name="password">
        </div>
    
        <label class="form-label" for="password2">Repeat Password</label>
        <div class="campo">
        <input class="form-control mb-3 p-4 justify-content-center" required type="password" id="password2" placeholder="Repeat your Password" name="password2">
        </div>
    <input id="btnsingup" class="btn btn-primary p-4 loginS" type="submit" class="boton" value="SING UP">
</form>
</div>

<div class="acciones justify-content-center">
    <a href="/olvide">Forgot your password?</a>
</div>

</div>


<?php include_once __DIR__ . "/../layout/footer.php";
$script .= '<script src="build/js/login.js"></script>';
?>