<!--Contenido Central-->
<h1>Algunos productos destacados</h1>

<?php while ($producto_mostrar = $productos->fetch(PDO::FETCH_OBJ)) : ?>
    <!-- $producto_mostrar es una variable que almacena cada fila de la base de datos como
      un objeto mientras se recorre el conjunto de resultados ($productos). -->

    <!-- fetch(PDO::FETCH_OBJ) obtiene una fila de la consulta como un objeto, en lugar de un array asociativo. -->
    <div class="productos">
        <div class="producto">
            <a href="<?=base_url?>producto/ver&id=<?=$producto_mostrar->id ?>">
                <?php if ($producto_mostrar->imagen != null): ?>
                    <img src="<?= base_url ?>assets/img/uploads/<?= $producto_mostrar->imagen ?>" alt="">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/icono-libro-256px.jpg" alt="">
                <?php endif; ?>
                <h2><?= $producto_mostrar->nombre ?></h2>
            </a>
            <p><?= $producto_mostrar->precio ?></p>
            <a href="" class="button">Comprar</a>
        </div>
    <?php endwhile; ?>
    </div>