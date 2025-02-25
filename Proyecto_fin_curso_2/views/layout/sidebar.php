<!--Barra Lateral-->

<section id="lateral">
    <ul>
        <!-- En caso de que se haya iniciado sesion mostrará este mensaje -->
        <?php if (isset(($_SESSION['identidad']))): ?>
            <h2 id="usu_2">Bienvenido: <?= $_SESSION['identidad']->nombre ?> <?= $_SESSION['identidad']->apellidos ?></h2>
        <?php endif; ?>

        <?php if (isset($_SESSION['admin'])): ?>
            <li><a href="<?= base_url ?>categoria/index">Gestionar categorias</a></li>
            <li><a href="<?= base_url ?>producto/gestion">Gestionar productos</a></li>
            <li><a href="#">Gestionar pedidos</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['identidad'])): ?>
            <li><a href="<?= base_url ?>usuario/listado">Gestionar usuarios</a></li>
            <li><a href="#">Mis pedidos</a></li>
        <?php else: ?>
            <li><a href="<?= base_url ?>usuario/registro">Registrate Aqui</a></li>
        <?php endif; ?>
    </ul>


</section>

<!--Contenido Central-->
<div id="central">