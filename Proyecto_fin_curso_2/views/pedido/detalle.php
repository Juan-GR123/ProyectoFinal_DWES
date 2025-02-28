<?php

use Helpers\Utils;

?>

<h1>Detalles del pedido</h1>

<?php if (isset($pedido)): ?>
    <?php if (isset($_SESSION['admin'])): ?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?= base_url ?>pedido/estado_pedidos" method="POST">
            <input type="hidden" value="<?= $pedido->id ?>" name="pedido_id">
            <select name="estado">
                <option value="confirm" <?= $pedido->estado == "confirm" ? 'selected' : ''; ?>>Pendiente</option>
                <option value="preparation" <?= $pedido->estado == "preparation" ? 'selected' : ''; ?>>En preparacion</option>
                <option value="ready" <?= $pedido->estado == "ready" ? 'selected' : ''; ?>>Preparando para el envio</option>
                <option value="sender" <?= $pedido->estado == "sended" ? 'selected' : ''; ?>>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
    <?php endif; ?>

    <h3>Direccion de envio</h3>
    Provincia: <?= $pedido->provincia ?> <br>
    Localidad: <?= $pedido->localidad ?><br>
    Dirección: <?= $pedido->direccion ?> <br><br>


    <h3>Datos del pedido: </h3>
    <br>
    Estado: <?= Utils::estado($pedido->estado) ?> <br>
    Número de pedido: <?= $pedido->id ?> <br>
    Total a pagar: <?= $pedido->coste ?> $ <br>
    Productos: <br><br>

    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php if (isset($productos) && is_array($productos)): ?>
            <?php foreach ($productos as $producto): ?>
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
                        <?= $producto->precio ?>$
                    </td>

                    <td>
                        x<?= $producto->unidades ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron productos para este pedido.</p>
        <?php endif; ?>
    </table>

<?php endif; ?>