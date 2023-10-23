<div class="contenedor crear">
    <?php
        include_once __DIR__ . '/../templates/nombre-sitio.php';
    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form action="/crear" class="formulario" method="POST">
        <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre" name="nombre" value="<?php echo $usuario->nombre ?>">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu email" name="email" value="<?php echo $usuario->email ?>">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu password" name="password">
            </div>
            <div class="campo">
                <label for="password2">Confirma password</label>
                <input type="password" id="password2" placeholder="Confirma tu password" name="password2">
            </div>
            <input type="submit" class="boton" value="Crear Cuenta">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/olvide">¿Olvidaste tu Contraseña</a>
        </div>
    </div>
</div>