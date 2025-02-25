<h1>Gestion de productos</h1>

<div class="botones-categorias">
    <a href="<?= base_url ?>producto/crear" class="button button-small">
        Crear Producto
    </a>

    <a href="<?= base_url ?>producto/eliminar" class="button button-small">
        Borrar Producto
    </a>

</div>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
    </tr>
    <?php foreach ($productos as $pro): ?>
        <tr>
            <td><?= $pro['id']; ?></td>
            <td><?= $pro['nombre']; ?></td>
            <td><?= $pro['precio']; ?></td>
            <td><?= $pro['stock']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>