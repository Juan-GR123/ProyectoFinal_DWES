<?php

use Helpers\Utils;

if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'failed') {
    // Mostramos un mensaje de error con estilo
    echo "Error al intentar borrar el pedido. Por favor, inténtalo de nuevo.";
    // Limpiamos el mensaje de la sesión para que no se vuelva a mostrar
    unset($_SESSION['pedido']);
} elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'eliminado') {
    echo "El pedido se ha borrado con exito";
    // Limpiamos el mensaje de la sesión para que no se vuelva a mostrar
    unset($_SESSION['pedido']);
}

?>

<?php if (isset($gestion)): ?>
    <h1>Gestionar pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>
<table>
    <tr>
        <th>Nº Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php
    foreach ($pedidos as $ped): //elemento es un array no un objeto
    ?>
        <tr>
            <td>
                <a href="<?= base_url ?>pedido/detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a>
            </td>

            <td>
                <?= $ped->coste ?>
            </td>

            <td>
                <?= $ped->fecha ?>
            </td>

            <td>
                <?= Utils::estado($ped->estado) ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>