<h1>Modificar Usuario</h1>

<form action="<?= base_url ?>usuario/update" method="POST">
    <input type="hidden" name="id" value="<?= $usuarioDatos->id ?>"> 
    <!-- usuarioDatos es creado en editar() en la clase usuarioController y contiene los valores necesarios -->

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= $usuarioDatos->nombre ?>" required><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?= $usuarioDatos->apellidos ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= $usuarioDatos->email ?>" required><br>

    <label for="password">Contraseña: </label>
    <input type="password" name="password" placeholder="Agrega contraseña nueva"><br>

    <?php if (isset($_SESSION['admin'])): ?>
        <label for="rol">Rol:</label>
        <select name="rol">
            <option value="user" <?= $usuarioDatos->rol == 'user' ? 'selected' : '' ?>>Usuario</option>
            <option value="admin" <?= $usuarioDatos->rol == 'admin' ? 'selected' : '' ?>>Administrador</option>
        </select><br>
    <?php endif; ?>

    <input type="submit" value="Guardar Cambios">
</form>
