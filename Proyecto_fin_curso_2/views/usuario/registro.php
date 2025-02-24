<?php 
use Helpers\Utils;
?>

<div id="registro_div">

    <h1 id="reg">Registrarse</h1><br>

    <!--Si la session registro esta completa entonces te lo indica 
    y si falta alguna valor también te lo indicará-->

    <?php if (isset($_SESSION['registro']) && $_SESSION['registro'] == 'complete'): ?>
        <strong class="verde">Registro completado correctamente</strong>
    <?php elseif (isset($_SESSION['registro']) && $_SESSION['registro'] == 'failed'): ?>
        <strong class="rojo">Registro fallido, introduce bien los datos</strong>
    <?php endif; ?>
    <?php Utils::cerrarSesion('registro'); ?>


    <!--Este sera el formualrio de registro-->
    <form action="<?= base_url ?>usuario/save" method="POST" class="registrar">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required />

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required />

        <label for="email">Email</label>
        <input type="email" name="email" required />

        <label for="password">Contraseña</label>
        <input type="password" name="password" required />

        <label for="rol">Rol</label>
        <input type="text" name="rol" required pattern="^(user|admin)$" />

        <input type="submit" value="Registrarse" />
    </form>
</div>