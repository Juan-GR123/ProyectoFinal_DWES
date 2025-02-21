<!--Barra Lateral-->
<aside id="lateral">
    <div id="login" class="block">
        <h3>Entrar a la Web</h3>
        <?php if(!isset($_SESSION['identity'])): ?>
        <form action="<?=base_url?>usuario/login" method="post">
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Password</label>
            <input type="password" name="password">
            <input type="submit" value="Enviar">
        </form>
        <?php else: ?>
            <h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
        <?php endif; ?>

        <ul>
            <li><a href="#">Mis pedidos</a></li>
            <li><a href="#">Gestionar pedidos</a></li>
            <li><a href="#">Gestionar categorias</a></li>
            <li><a href="<?=base_url?>usuario/logout">Cerrar Sesión</a></li>
        </ul>
    </div>

</aside>

<!--Contenido Central-->
<div id="central">