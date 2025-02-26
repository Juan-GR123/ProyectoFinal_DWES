<?php

use Helpers\Utils;


if (isset($editar) && isset($pro) && is_object($pro)):
?>
    <h1>Editar producto <?= $pro->nombre ?></h1>
    <?php $url =  base_url . 'producto/save&id=' . $pro->id; ?>
<?php else: ?>
    <h1>Crear nuevo producto</h1>
    <?php $url =  base_url . 'producto/save'; ?>
<?php endif; ?>

<div class="form-container">
    <form action="<?= $url ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>">

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"><?= isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>

        <label for="precio">Precio</label>
        <input type="text" name="precio" value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''; ?>">

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?= isset($pro) && is_object($pro) ? $pro->stock : ''; ?>">

        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::mostrar_Categorias(); ?>
        <select name="categoria">
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" value="<?= isset($pro) && is_object($pro) && $cat['id'] == $pro->categoria_id ? 'selected' : ''; ?>">
                    <?= $cat['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="imagen">Imagen</label>
        <?php if (isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
            <img src="<?= base_url ?>/assets/img/uploads/<?=$pro->imagen?>" class="foto">

        <?php endif; ?>

        <input type="file" name="imagen">

        <input type="submit" name="Guardar">
    </form>

</div>