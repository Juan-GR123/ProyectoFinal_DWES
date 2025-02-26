<!--Contenido Central-->
<h1>Algunos productos destacados</h1>

<?php while($producto_mostrar = $productos -> fetch(PDO::FETCH_OBJ)) : ?>
<div class="productos">
    <div class="producto">
        <img src="<?=base_url?>assets/img/uploads/<?=$producto_mostrar->imagen?>" alt="">
        <h2><?=$producto_mostrar->nombre ?></h2>
        <p><?=$producto_mostrar->precio ?></p>
        <a href="" class="button">Comprar</a>
    </div>
<?php endwhile; ?>


    <!-- <div class="producto">
        <img src="assets/img/icono-libro-256px.jpg" alt="">
        <h2>Libros con portada antigua</h2>
        <p>20 euros</p>
        <a href="" class="button">Comprar</a>
    </div>

    <div class="producto">
        <img src="assets/img/icono-libro-256px.jpg" alt="">
        <h2>Libros con portada antigua</h2>
        <p>20 euros</p>
        <a href="" class="button">Comprar</a>
    </div>-->
</div> 

