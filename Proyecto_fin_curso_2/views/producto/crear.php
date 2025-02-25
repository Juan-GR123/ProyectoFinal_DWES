<?php

use Helpers\Utils;

?>


<h1>Crear nuevos productos</h1>

<div class="form-container">

    <form action="<?= base_url ?>producto/save" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre">

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"></textarea>

        <label for="precio">Precio</label>
        <input type="text" name="precio">

        <label for="stock">Stock</label>
        <input type="number" name="stock">

        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::mostrar_Categorias(); ?>
        <select name="categoria">
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>">
                    <a href="#"><?= $cat['nombre'] ?></a>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="imagen">Imagen</label>
        <input type="file" name="imagen">

        <input type="submit" name="Guardar">
    </form>

</div>