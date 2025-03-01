<?php 
use Helpers\Utils;

?>


<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
    <strong class="verde" id="mensaje">Registro completado correctamente</strong>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'failed'): ?>
    <strong class="rojo" id="mensaje">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::cerrarSesion('pedido'); ?>


<?php if (isset($_SESSION['identidad'])): ?>
    <h1>Hacer pedido</h1>
    <p>
        <a href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>
    </p>
    <form action="<?= base_url . 'pedido/add' ?>" method="POST">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required>

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>

        <input type="submit" value="Confirmar pedido">
    </form>


<?php else: ?>
    <h1>Necesitas estar identificado</h1>
    <p>Necesitas estar logueado en la web para poder realizar tu pedido</p>
<?php endif; ?>



<!-- Esto esta con javascript porque no sabia como hacerlo con php -->
<script>
    // Espera 5 segundos y oculta el mensaje
    setTimeout(() => {
        const mensaje = document.getElementById('mensaje');
        if (mensaje) {
            mensaje.style.display = 'none';
        }
    }, 5000);
</script>