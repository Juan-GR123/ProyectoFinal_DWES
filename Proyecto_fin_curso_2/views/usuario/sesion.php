<!--Este será el formularío para iniciar sesión-->

<?php if (isset($_SESSION['error_login'])): ?>
    <div class="error_login">
        <strong class="rojo"><?= htmlspecialchars($_SESSION['error_login']) ?></strong>
    </div>
    <?php unset($_SESSION['error_login']); ?>
<?php endif; ?>


<section id="centrar">
    <div id="login" class="block">
        <h3>Entrar a la Web</h3>
        <?php if(!isset($_SESSION['identidad'])): ?>
        <form action="<?=base_url?>usuario/login" method="post">
            <label for="email">Email: </label>
            <input type="email" name="email">
            <label for="password">Contraseña: </label>
            <input type="password" name="password">
            <input type="submit" value="Enviar">
        </form>
        <?php else: ?>
            <h2 id="usu">Aqui no hay nada que ver</h2>
        <?php endif; ?>
    </div>

</section>

</div>

