<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices la transferencia
        bancaria a la cuenta 7548392424238912ASS con el coste pedido sera procesado y enviado.
    </p>
    <br>
    <?php if (isset($pedido) && isset($productos)): ?>

        <h3>Datos del pedido: </h3>
        <br>
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
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
    <h1>Tu perdido NO ha podido procesarse</h1>
    <p>Hubo un problema al procesar tu pedido. Por favor, intenta nuevamente o contacta con el soporte.</p>
<?php endif; ?>