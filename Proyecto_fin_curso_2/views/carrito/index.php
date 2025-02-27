<h1>Carrito de la compra</h1>

<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
    <?php

use Helpers\Utils;

    foreach ($carrito as $indice => $elemento): //elemento es un array no un objeto
        $producto = $elemento['producto'];

    ?>
        <tr>
            <td>
                <?php if ($producto->imagen != null): ?>
                    <img src="<?= base_url ?>assets/img/uploads/<?= $producto->imagen ?>" class="img_carrito" alt="">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/icono-libro-256px.jpg" class="img_carrito" alt="">
                <?php endif; ?>
            </td>

            <td>
               <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?= $producto->nombre ?></a> 
            </td>

            <td>
            <?= $producto->precio ?>
            </td>

            <td>
            <?= $elemento['unidades'] ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<?php 
    $mostrar = Utils::Carrito_mostrar(); 
?>
<br>
<h3>Precio Total: <?=$mostrar['total'] ?>$</h3>
<a href="" class="button" id="button-pedido"> Realizar pedido</a>
