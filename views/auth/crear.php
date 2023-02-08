<div class="contenedor crear">
    <?php include_once __DIR__ . "/../templates/nombre-sitio.php"; ?>

<div class="contenedor-sm">
    <p class="descripcion-pagina">Crea tu Cuenta</p>
    <p class="descripcion-pagina">No Uses Tu Nombre Real</p>
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
    <form class="formulario" action="/crear" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input required type="text" id="nombre" placeholder="Tu Nombre" name="nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>
    <div class="campo"> 
        <label for="email">Email</label>
        <input required type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo s($usuario->email); ?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input required type="password" id="password" placeholder="Tu Password" name="password">
    </div>
    <div class="campo">
        <label for="password2">Repitir Password</label>
        <input required type="password" id="password2" placeholder="Repite tu Password" name="password2">
    </div>
    <input type="submit" class="boton" value="Crear Cuenta">
</form>

<div class="acciones">
    <a href="/login">¿Ya tienes cuenta? Iniciar Sesion</a>
    <a href="/olvide">¿Olvidaste tu Password?</a>
</div>
</div>

</div>