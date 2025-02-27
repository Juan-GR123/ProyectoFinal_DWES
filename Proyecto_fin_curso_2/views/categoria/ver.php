<?php if (isset($categoria)): ?>
    <h1><?= $categoria->nombre ?></h1>
    <?php if ($productos->rowCount()== 0): ?>
        <p>No hay productos para mostrar</p>
    <?php else: ?>
        <?php while ($producto_mostrar = $productos->fetch(PDO::FETCH_OBJ)) : ?>
            <div class="producto">
                <?php if ($producto_mostrar->imagen != null): ?>
                    <img src="<?= base_url ?>assets/img/uploads/<?= $producto_mostrar->imagen ?>" alt="">
                <?php else: ?>
                    <img src="<?=base_url?>assets/img/icono-libro-256px.jpg" alt="">
                <?php endif; ?>
                <h2><?= $producto_mostrar->nombre ?></h2>
                <p><?= $producto_mostrar->precio ?></p>
                <a href="" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
<?php else: ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>