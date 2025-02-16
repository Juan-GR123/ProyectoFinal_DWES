<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styles.css">
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

        <nav>
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
            </ul>
        </nav>

        <div id="contenido">
            <!--Barra Lateral-->
            <aside id="lateral">
                <div id="login" class="block_aside">
                    <form action="#" method="post">
                        <label for="email">Email</label>
                        <input type="email" name="email" />
                        <label for="password">Password</label>
                        <input type="password" name="password" />
                        <input type="submit" value="Enviar" />
                    </form>

                    <a href="#">Mis pedidos</a>
                    <a href="#">Gestionar pedidos</a>
                    <a href="#">Gestionar categorias</a>

                </div>

            </aside>
            <!--Contenido Central-->
            <div id="central">

                <div class="producto">
                    <img src="assets/img/icono-libro-256px.png" alt="">
                    <h2>Libros con portada antigua</h2>
                    <p>20 euros</p>
                    <a href="">Comprar</a>
                </div>

                <div class="producto">
                    <img src="assets/img/icono-libro-256px.png" alt="">
                    <h2>Libros con portada antigua</h2>
                    <p>20 euros</p>
                    <a href="">Comprar</a>
                </div>

                <div class="producto">
                    <img src="assets/img/icono-libro-256px.png" alt="">
                    <h2>Libros con portada antigua</h2>
                    <p>20 euros</p>
                    <a href="">Comprar</a>
                </div>

            </div>
        </div>

        <!--Pie de página-->
        <footer id="footer">
            <p>Desarrollado por Juan G WEB</p>
        </footer>
    </div>
</body>

</html>