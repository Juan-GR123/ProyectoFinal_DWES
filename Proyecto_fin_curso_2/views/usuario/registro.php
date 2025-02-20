<h1>Registrarse</h1>

<?php
if (isset($_SESSION['register'])) {
    echo $_SESSION['register'];
}
?>

<form action="<?=base_url?>usuario/save" method="POST">
    <label for="nombre">Nombra</label>
    <input type="text" name="nombre" required />

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" required />

    <label for="email">Email</label>
    <input type="email" name="email" required />

    <label for="password">Contraseña</label>
    <input type="password" name="password" required />

    <input type="submit" value="Registrarse" />
</form>