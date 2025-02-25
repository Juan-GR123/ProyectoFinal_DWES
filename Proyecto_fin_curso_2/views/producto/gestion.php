<?php

use Helpers\Utils;

?>

<h1>Gestion de productos</h1>

<div class="botones-categorias">
    <a href="<?= base_url ?>producto/crear" class="button button-small">
        Crear Producto
    </a>
</div>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="verde" id="mensaje">Producto creado correctamente</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed'): ?>
    <strong class="rojo" id="mensaje">Producto fallido, introduce bien los datos</strong>
<?php elseif (isset($_SESSION['error_producto'])): ?>
    <strong class="rojo" id="mensaje"><?php echo $_SESSION['error_producto'] ?></strong>
<?php endif; ?>
<?php Utils::cerrarSesion('producto'); ?>
<?php Utils::cerrarSesion('error_producto'); ?>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>
    <?php foreach ($productos as $pro): ?>
        <tr>
            <td><?= $pro['id']; ?></td>
            <td><?= $pro['nombre']; ?></td>
            <td><?= $pro['precio']; ?></td>
            <td><?= $pro['stock']; ?></td>
            <td>
                <a href="<?= base_url ?>/producto/editar?id=<?$pro->id?>" class="enlaces-gestion">Editar</a>
                <a href="<?= base_url ?>/producto/eliminar?id=<?$pro->id?>" class="enlaces-gestion">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<!-- Esto esta con javascript porque no sabia como hacerlo con php -->
<script>
    // Espera 5 segundos y oculta el mensaje
    setTimeout(() => {
        const mensaje = document.getElementById('mensaje');
        if (mensaje) {
            mensaje.style.display = 'none';
        }
    }, 5000);
</script>