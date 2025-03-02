<h1>Listado de Usuarios</h1>


<!-- Mensajes de eliminación -->
<?php if (isset($_SESSION['delete'])): ?>
    <div class="<?= $_SESSION['delete'] == 'complete' ? 'success' : 'error' ?>">
        <strong>
            <?= $_SESSION['delete'] == 'complete' ? 'Usuario eliminado correctamente.' : 'Error al eliminar usuario.' ?>
        </strong>
    </div>
    <?php unset($_SESSION['delete']); ?>
<?php endif; ?>


<?php if (isset($_SESSION['error_update'])): ?>
    <div class="error_update">
        <strong class="rojo"><?= htmlspecialchars($_SESSION['error_update']) ?></strong>
    </div>
    <?php unset($_SESSION['error_update']); ?>
<?php endif; ?>

<?php
if (isset($_SESSION['admin'])):
?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario->id ?></td>
                <td><?= $usuario->nombre ?></td>
                <td><?= $usuario->apellidos ?></td>
                <td><?= $usuario->email ?></td>
                <td><?= $usuario->rol ?></td>
                <td>
                    <?php if (isset($_SESSION['admin']) || $_SESSION['identidad']->id == $usuario->id): ?>
                        <a href="<?= base_url ?>usuario/editar&id=<?= $usuario->id ?>">Editar</a>
                        <!-- le mandas el id por url para identificar qué usuario se va a editar en la base de datos. -->
                        <a href="<?= base_url ?>usuario/eliminar&id=<?= $usuario->id ?>">Eliminar</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php else: ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <?php if ($_SESSION['identidad']->id == $usuario->id): ?>
                <tr>
                    <td><?= $usuario->id ?></td>
                    <td><?= $usuario->nombre ?></td>
                    <td><?= $usuario->apellidos ?></td>
                    <td><?= $usuario->email ?></td>
                    <td><?= $usuario->rol ?></td>
                    <td>
                        <a href="<?= base_url ?>usuario/editar&id=<?= $usuario->id ?>">Editar</a>
                        <a href="<?= base_url ?>usuario/eliminar&id=<?= $usuario->id ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
<?php endif; ?>