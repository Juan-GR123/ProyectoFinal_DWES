<h1>Carrito de la compra</h1>

<?php

use Helpers\Utils;


if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1):

?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php



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
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                </td>

                <td>
                    <?= $producto->precio ?>
                </td>

                <td>
                    <div class="updown-unidades">
                        <a href="<?= base_url ?>carrito/aumentar&index=<?= $indice ?>" class="button sumar">+</a>
                        <?= $elemento['unidades'] ?>
                        <a href="<?= base_url ?>carrito/disminuir&index=<?= $indice ?>" class="button restar">-</a>
                    </div>
                </td>
                <td>
                    <a href="<?= base_url ?>carrito/delete&index=<?= $indice ?>" class="button button-carrito" id="quitar_producto"> Quitar Producto</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


    <?php
    $mostrar = Utils::Carrito_mostrar();
    ?>
    <br>
    <h3>Precio Total: <?= $mostrar['total'] ?>$</h3>
    <div class="botones-carrito">
        <a href="<?= base_url ?>pedido/hacer" class="button" id="boton1" > Realizar pedido</a>
        <a href="<?= base_url ?>carrito/delete_toditos" class="button" id="boton2"> Vaciar carrito</a>
    </div>
<?php else: ?>
    <p>El carrito está vacio, añade algun producto</p>
<?php endif; ?>