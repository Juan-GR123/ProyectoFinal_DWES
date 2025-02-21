     <section id="lateral">
         <ul>

             <?php if (isset(($_SESSION['identidad']))): ?>
                 <h2 id="usu_2">Bienvenido: <?= $_SESSION['identidad']->nombre ?> <?= $_SESSION['identidad']->apellidos ?></h2>
             <?php endif; ?>

             <?php if (isset($_SESSION['admin'])): ?>
                 <li><a href="#">Gestionar categorias</a></li>
                 <li><a href="#">Gestionar productos</a></li>
                 <li><a href="#">Gestionar pedidos</a></li>
             <?php endif; ?>

             <?php if (isset($_SESSION['identidad'])): ?>
                 <li><a href="#">Mis pedidos</a></li>
                 <li><a href="<?= base_url ?>usuario/logout">Cerrar Sesión</a></li>
             <?php endif; ?>

         </ul>


     </section>

     <!--Contenido Central-->
     <div id="central">