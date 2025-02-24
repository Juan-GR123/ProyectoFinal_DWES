<h1>Gestionar Categorias</h1>

<a href="<?=base_url?>categoria/crear" class="button button-small">
    Crear categoria
</a>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>
    <?php foreach ($categorias as $cat): ?>
        <tr>
            <td><?= $cat['id']; ?></td>
            <td><?= $cat['nombre']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>