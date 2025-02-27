<?php if (isset($pro)): ?>
    <h1><?= $pro->nombre ?></h1>
    <div id="detalles_producto">

        <?php if ($pro->imagen != null): ?>
            <img src="<?= base_url ?>assets/img/uploads/<?= $pro->imagen ?>" alt="">
        <?php else: ?>
            <img src="<?= base_url ?>assets/img/icono-libro-256px.jpg" alt="">
        <?php endif; ?>
        <div id="detalles_producto2">
            <h2><?= $pro->descripcion ?></h2>
            <p><?= $pro->precio ?>$</p>
            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>