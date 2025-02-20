<?php 
require 'autoload.php';

if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';
}else{
    echo "La pagina que buscas no existe";
    exit(); 
}

if(class_exists($nombre_controlador)){
    $controlador= new $nombre_controlador();


    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }else{
        echo "La página que buscas no existe";
    }

}else{
    echo "La página que buscas no existe";
}


?>



<!--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div id="contenedor">
        <header id="header">
            <div id="logo">
                <img src="./assets/img/icono-libro-256px.png" alt="Logo libro">
                <a href="index.php">
                    Tienda de libros
                </a>
            </div>
        </header>

        <nav id="menu">
            <ul>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#">Categoria 1</a>
                </li>
                <li>
                    <a href="#">Categoria 2</a>
                </li>
                <li>
                    <a href="#">Categoria 3</a>
                </li>
                <li>
                    <a href="#">Categoria 4</a>
                </li>
                <!--<li>
                    <a href="#">Categoria 5</a>
                </li>-->
       <!--     </ul>
        </nav><br>

        <div id="contenido">
            <!--Barra Lateral-->
           <!-- <aside id="lateral">
                <div id="login" class="block">
                    <h3>Entrar a la Web</h3>
                    <form action="#" method="post">
                        <label for="email">Email</label>
                        <input type="email" name="email">
                        <label for="password">Password</label>
                        <input type="password" name="password">
                        <input type="submit" value="Enviar">
                    </form>

                    <ul>
                        <li><a href="#">Mis pedidos</a></li>
                        <li><a href="#">Gestionar pedidos</a></li>
                        <li><a href="#">Gestionar categorias</a></li>
                    </ul>
                </div>

            </aside>
            <!--Contenido Central-->
       <!--     <div id="central">
                <h1>Productos destacados</h1>
                <div class="productos">
                    <div class="producto">
                        <img src="assets/img/icono-libro-256px.png" alt="">
                        <h2>Libros con portada antigua</h2>
                        <p>20 euros</p>
                        <a href="" class="button">Comprar</a>
                    </div>

                    <div class="producto">
                        <img src="assets/img/icono-libro-256px.png" alt="">
                        <h2>Libros con portada antigua</h2>
                        <p>20 euros</p>
                        <a href="" class="button">Comprar</a>
                    </div>

                    <div class="producto">
                        <img src="assets/img/icono-libro-256px.png" alt="">
                        <h2>Libros con portada antigua</h2>
                        <p>20 euros</p>
                        <a href="" class="button">Comprar</a>
                    </div>

                </div>

            </div>
        </div>

        <!--Pie de página-->
     <!--   <footer id="footer">
            <p>Desarrollado por Juan G WEB</p>
        </footer>
    </div>
</body>

</html>-->